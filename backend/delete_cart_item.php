<?php
session_start();
require '../includes/db.php';

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $cart_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $cart_id, $user_id);
    $stmt->execute();

    echo "success";
} else {
    echo "error";
}
?>
