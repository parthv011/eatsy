<?php 
session_start();
require('header.php');

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle cart actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] ?? '' === 'update_quantity') {
        $item_id = $_POST['item_id'];
        $quantity = max(1, intval($_POST['quantity']));
        if (isset($_SESSION['cart'][$item_id])) {
            $_SESSION['cart'][$item_id]['quantity'] = $quantity;
        }
    }

    if ($_POST['action'] ?? '' === 'remove_item') {
        $item_id = $_POST['item_id'];
        if (isset($_SESSION['cart'][$item_id])) {
            unset($_SESSION['cart'][$item_id]);
        }
    }

    if ($_POST['action'] ?? '' === 'clear_cart') {
        $_SESSION['cart'] = [];
    }
    
    // Redirect after POST to prevent form resubmission issues
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Calculate totals
$subtotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$tax = $subtotal * 0.18; // 18% GST
$delivery_fee = $subtotal > 500 ? 0 : 50;
$total = $subtotal + $tax + $delivery_fee;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            background-color: #f7ece3ff;
            min-height: 100vh;
        }
        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .cart-item {
            background: white;
            border-radius: 10px;
            margin-bottom: 15px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .quantity-btn {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .quantity-btn:hover {
            background: #e9ecef;
        }
        .quantity-display {
            font-weight: bold;
            min-width: 30px;
            text-align: center;
        }
        .remove-btn {
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .remove-btn:hover {
            background: #c82333;
        }
        .cart-summary {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            position: sticky;
            top: 20px;
        }
        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .checkout-btn {
            background: #e62e4a;
            border: none;
            color: white;
            padding: 12px 0;
            border-radius: 8px;
            font-weight: bold;
            font-size: 1.1rem;
            width: 100%;
        }
        .checkout-btn:hover {
            background: #cf2941;
        }
    </style>
</head>
<body>

<div class="cart-container">
    <div class="row">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Shopping Cart</h2>
                <?php if (!empty($_SESSION['cart'])): ?>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="action" value="clear_cart">
                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Clear all items from cart?')">
                        <i class="fas fa-trash"></i> Clear Cart
                    </button>
                </form>
                <?php endif; ?>
            </div>

            <?php if (empty($_SESSION['cart'])): ?>
            <div class="empty-cart">
                <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                <h4>Your cart is empty</h4>
                <p class="text-muted">Add some delicious items to your cart!</p>
                <a href="menu.php" class="btn btn-primary">Browse Menu</a>
            </div>
            <?php else: ?>
            
            <div id="cart-items">
                <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                <div class="cart-item">
                    <div class="row align-items-center">
                        <div class="col-md-2 col-3">
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="item-image">
                        </div>
                        <div class="col-md-4 col-9">
                            <div class="item-details">
                                <h6 class="mb-1"><?php echo htmlspecialchars($item['name']); ?></h6>
                                <p class="text-muted small mb-0"><?php echo htmlspecialchars($item['description'] ?? 'Delicious item'); ?></p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 text-center">
                            <div class="quantity-controls">
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="update_quantity">
                                    <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($id); ?>">
                                    <input type="hidden" name="quantity" value="<?php echo max(1, $item['quantity'] - 1); ?>">
                                    <button type="submit" class="quantity-btn" <?php echo $item['quantity'] <= 1 ? 'disabled' : ''; ?>>
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </form>
                                <span class="quantity-display"><?php echo $item['quantity']; ?></span>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="update_quantity">
                                    <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($id); ?>">
                                    <input type="hidden" name="quantity" value="<?php echo $item['quantity'] + 1; ?>">
                                    <button type="submit" class="quantity-btn">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-2 col-4 text-end">
                            <div class="item-price">₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></div>
                            <small class="text-muted">₹<?php echo number_format($item['price'], 2); ?> each</small>
                        </div>
                        <div class="col-md-1 col-2 text-end">
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="action" value="remove_item">
                                <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($id); ?>">
                                <button type="submit" class="remove-btn" onclick="return confirm('Remove this item from cart?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($_SESSION['cart'])): ?>
        <div class="col-lg-4">
            <div class="cart-summary">
                <h5 class="mb-3">Order Summary</h5>
                
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <span>₹<?php echo number_format($subtotal, 2); ?></span>
                </div>
                
                <div class="d-flex justify-content-between mb-2">
                    <span>GST (18%)</span>
                    <span>₹<?php echo number_format($tax, 2); ?></span>
                </div>
                
                <div class="d-flex justify-content-between mb-3">
                    <span>Delivery Fee</span>
                    <span>
                        <?php if ($delivery_fee == 0): ?>
                            <span class="text-success">FREE</span>
                        <?php else: ?>
                            ₹<?php echo number_format($delivery_fee, 2); ?>
                        <?php endif; ?>
                    </span>
                </div>
                
                <?php if ($subtotal < 500 && $delivery_fee > 0): ?>
                <div class="alert alert-info small">
                    Add ₹<?php echo number_format(500 - $subtotal, 2); ?> more for free delivery!
                </div>
                <?php endif; ?>
                
                <hr>
                
                <div class="d-flex justify-content-between mb-3">
                    <strong>Total</strong>
                    <strong>₹<?php echo number_format($total, 2); ?></strong>
                </div>
                
                <a href="checkout.php" class="btn checkout-btn">
                    <i class="fas fa-lock me-2"></i>Proceed to Checkout
                </a>
                
                <a href="menu.php" class="btn btn-outline-secondary w-100 mt-2">
                    <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php require('footer.php'); ?>
</body>
</html>