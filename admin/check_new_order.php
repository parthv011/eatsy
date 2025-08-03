<?php
session_start();
require('db_connection.php'); // your DB connection

$query = "SELECT COUNT(*) as cnt FROM orders WHERE status = 'Pending'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

echo json_encode(['new_orders_count' => (int)$row['cnt']]);
?>
