<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: backend/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $item_id = intval($_POST['item_id']);

    // Check if item exists in cart
    $stmt = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id=? AND item_id=?");
    $stmt->bind_param("ii", $user_id, $item_id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $new_qty = $row['quantity'] + 1;
        $update = $conn->prepare("UPDATE cart SET quantity=? WHERE id=?");
        $update->bind_param("ii", $new_qty, $row['id']);
        $update->execute();
    } else {
        $insert = $conn->prepare("INSERT INTO cart(user_id, item_id, quantity) VALUES (?, ?, 1)");
        $insert->bind_param("ii", $user_id, $item_id);
        $insert->execute();
    }

    header("Location: user/menu.php?added=1");
}
?>
