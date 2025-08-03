<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    echo "Please log in to view orders.";
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT o.id, o.ordered_at, SUM(oi.quantity * m.price) AS total
        FROM orders o
        JOIN order_items oi ON o.id = oi.order_id
        JOIN menu_items m ON oi.item_id = m.id
        WHERE o.user_id = ?
        GROUP BY o.id, o.ordered_at
        ORDER BY o.ordered_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$orders = $stmt->get_result();
?>

<div class="container mt-4">
    <h4>Your Orders</h4>
    <?php while ($order = $orders->fetch_assoc()): ?>
        <div class="card mb-3 p-3">
            <h5>Order #<?= $order['id'] ?> — ₹<?= number_format($order['total'], 2) ?></h5>
            <small>Placed on <?= $order['ordered_at'] ?></small>
            <ul class="mt-2">
            <?php
                $items_sql = "SELECT m.name, oi.quantity, m.price 
                              FROM order_items oi
                              JOIN menu_items m ON oi.item_id = m.id
                              WHERE oi.order_id = ?";
                $item_stmt = $conn->prepare($items_sql);
                $item_stmt->bind_param("i", $order['id']);
                $item_stmt->execute();
                $items = $item_stmt->get_result();

                while ($item = $items->fetch_assoc()):
            ?>
                <li><?= $item['name'] ?> × <?= $item['quantity'] ?> — ₹<?= number_format($item['price'] * $item['quantity'], 2) ?></li>
            <?php endwhile; ?>
            </ul>
        </div>
    <?php endwhile; ?>
</div>
