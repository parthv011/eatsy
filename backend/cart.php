<?php
require '../includes/db.php';
if (!isset($_SESSION['user_id'])) {
    echo "<div class='empty-cart'><h4>Please login to view your cart.</h4></div>";
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "SELECT c.id as cart_id, m.name, m.price, m.image, c.quantity, m.description 
        FROM cart c 
        JOIN menu_items m ON c.item_id = m.id 
        WHERE c.user_id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$grand_total = 0;
$item_count = 0;

while ($item = $result->fetch_assoc()):
    $item_total = $item['quantity'] * $item['price'];
    $grand_total += $item_total;
    $item_count += $item['quantity'];
?>
<div class="cart-item d-flex align-items-center justify-content-between" data-item-id="<?= $item['cart_id'] ?>">
    <div class="d-flex align-items-center gap-3">
        <img src="../includes/images/<?= $item['image'] ?>" class="item-image" alt="<?= $item['name'] ?>">
        <div class="item-details">
            <h6><?= $item['name'] ?></h6>
            <p class="item-description"><?= $item['description'] ?? '' ?></p>
            <div class="quantity-controls">
                <button class="quantity-btn" onclick="updateQuantity(<?= $item['cart_id'] ?>, -1)">-</button>
                <span class="quantity-display" id="qty-<?= $item['cart_id'] ?>"><?= $item['quantity'] ?></span>
                <button class="quantity-btn" onclick="updateQuantity(<?= $item['cart_id'] ?>, 1)">+</button>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column align-items-end">
        <div class="item-price">₹<span id="price-<?= $item['cart_id'] ?>"><?= number_format($item_total, 2) ?></span></div>
        <button class="remove-btn" onclick="removeItem(<?= $item['cart_id'] ?>)">
            <i class="fas fa-trash"></i>
        </button>
    </div>
</div>
<?php endwhile; ?>

<div class="cart-summary">
    <h4>Cart Summary</h4>
    <p>Total Items: <?= $item_count ?></p>
    <p>Grand Total: ₹<?= number_format($grand_total, 2) ?></p>
</div>
<div class="cart-actions">
    <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
    <a href="menu.php" class="btn btn-secondary">Continue Shopping</a>
</div>