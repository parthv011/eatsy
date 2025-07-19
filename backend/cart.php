<?php
session_start();
require '../includes/db.php';

$user_id = $_SESSION['user_id'];

$query = "SELECT c.id as cart_id, m.name, m.price, m.image, c.quantity 
          FROM cart c 
          JOIN menu_items m ON c.item_id = m.id 
          WHERE c.user_id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($item = $result->fetch_assoc()) {
    $total = $item['quantity'] * $item['price'];
    echo "<div>
            <img src='../includes/images/{$item['image']}' width='80'>
            <h4>{$item['name']}</h4>
            <p>₹{$item['price']} x {$item['quantity']} = ₹$total</p>
        </div>";
}
?>
