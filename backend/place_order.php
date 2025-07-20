<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Get cart items
$cart_sql = "SELECT * FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($cart_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$cart_items = $stmt->get_result();

if ($cart_items->num_rows === 0) {
    $_SESSION['msg'] = "Cart is empty!";
    header("Location: ../frontend/cart.php");
    exit;
}

// Insert order
$order_sql = "INSERT INTO orders (user_id) VALUES (?)";
$stmt = $conn->prepare($order_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$order_id = $conn->insert_id;

// Insert order items
$insert_item = $conn->prepare("INSERT INTO order_items (order_id, item_id, quantity) VALUES (?, ?, ?)");

foreach ($cart_items as $item) {
    $insert_item->bind_param("iii", $order_id, $item['item_id'], $item['quantity']);
    $insert_item->execute();
}

// Clear cart
$conn->query("DELETE FROM cart WHERE user_id = $user_id");

$_SESSION['msg'] = "Order placed successfully!";
header("Location: ../frontend/my_orders.php");
exit;
?>
