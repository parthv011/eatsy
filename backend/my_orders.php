<?php
session_start();
require '../includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../backend/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user's orders
$order_query = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY ordered_at DESC");
$order_query->bind_param("i", $user_id);
$order_query->execute();
$orders = $order_query->get_result();

if ($orders->num_rows > 0) {
    while ($order = $orders->fetch_assoc()) {
        echo "<h3>Order ID: {$order['id']} | Total: ₹{$order['total']} | Status: {$order['status']} | Date: {$order['ordered_at']}</h3>";

        // Fetch order items for this order
        $item_query = $conn->prepare("
            SELECT m.name, m.price, oi.quantity 
            FROM order_items oi 
            JOIN menu_items m ON oi.item_id = m.id 
            WHERE oi.order_id = ?");
        $item_query->bind_param("i", $order['id']);
        $item_query->execute();
        $items = $item_query->get_result();

        echo "<ul>";
        while ($item = $items->fetch_assoc()) {
            $subtotal = $item['price'] * $item['quantity'];
            echo "<li>{$item['name']} - ₹{$item['price']} x {$item['quantity']} = ₹{$subtotal}</li>";
        }
        echo "</ul><hr>";
    }
} else {
    echo "<p>You have no orders yet.</p>";
}
?>
