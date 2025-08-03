<?php 
require('header.php');
require_once '../includes/db.php';

// Check if user is logged in
session_start();
$user_logged_in = isset($_SESSION['user_id']);

// Handle order placement
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    if (!$user_logged_in) {
        $_SESSION['error'] = "Please login to place an order.";
        header("Location: login.php");
        exit;
    }
    
    $cart_data = json_decode($_POST['cart_data'], true);
    $total_amount = floatval($_POST['total_amount']);
    
    if (!empty($cart_data) && $total_amount > 0) {
        // Begin transaction
        $conn->begin_transaction();
        
        try {
            // Insert order - Fixed: using correct column name 'total'
            $stmt = $conn->prepare("INSERT INTO orders (user_id, total, status, ordered_at) VALUES (?, ?, 'Pending', NOW())");
            $stmt->bind_param("id", $_SESSION['user_id'], $total_amount);
            $stmt->execute();
            $order_id = $conn->insert_id;
            $stmt->close();
            
            // Insert order items - Fixed: using correct column names
            $stmt = $conn->prepare("INSERT INTO order_items (order_id, item_id, quantity, price) VALUES (?, ?, ?, ?)");
            
            foreach ($cart_data as $item_id => $item) {
                $stmt->bind_param("iiid", $order_id, $item_id, $item['quantity'], $item['price']);
                $stmt->execute();
            }
            $stmt->close();
            
            // Commit transaction
            $conn->commit();
            
            $_SESSION['success'] = "Order placed successfully! Order ID: #$order_id";
            header("Location: order_confirmation.php?order_id=$order_id");
            exit;
            
        } catch (Exception $e) {
            $conn->rollback();
            $_SESSION['error'] = "Failed to place order. Please try again. Error: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Cart is empty or invalid.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Food Delivery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            background-color: #f7ece3ff;
        }

        .cart-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .cart-header {
            background: linear-gradient(135deg, #BA8C63, #a67c56);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .cart-item {
            padding: 1.5rem;
            border-bottom: 1px solid #e9ecef;
            transition: background-color 0.3s ease;
        }

        .cart-item:hover {
            background-color: #f8f9fa;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            background-color: #BA8C63;
            border: none;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background-color: #a67c56;
            transform: scale(1.1);
        }

        .quantity-display {
            background-color: #f8f9fa;
            border: 2px solid #BA8C63;
            width: 60px;
            text-align: center;
            font-weight: bold;
            color: #BA8C63;
            border-radius: 8px;
            padding: 8px;
        }

        .remove-item {
            color: #dc3545;
            cursor: pointer;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .remove-item:hover {
            color: #c82333;
        }

        .cart-summary {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 15px;
            margin-top: 2rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .summary-total {
            font-size: 1.5rem;
            font-weight: bold;
            color: #BA8C63;
            border-top: 2px solid #BA8C63;
            padding-top: 1rem;
        }

        .checkout-btn {
            background: linear-gradient(135deg, #BA8C63, #a67c56);
            border: none;
            color: white;
            padding: 15px 30px;
            font-size: 1.1rem;
            border-radius: 50px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(186, 140, 99, 0.4);
        }

        .continue-shopping {
            color: #BA8C63;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .continue-shopping:hover {
            color: #a67c56;
        }

        .empty-cart {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
        }

        .empty-cart i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #BA8C63;
        }

        .offers-section {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .offer-code {
            background: #e8f5e8;
            border: 2px dashed #BA8C63;
            padding: 1rem;
            border-radius: 10px;
            text-align: center;
            margin: 1rem 0;
        }

        .apply-coupon {
            display: flex;
            gap: 10px;
        }

        .coupon-input {
            border: 2px solid #BA8C63;
            border-radius: 25px;
        }

        .apply-btn {
            background-color: #BA8C63;
            border: none;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
        }
    </style>
</head>

<body>
    <!-- Header Image -->
    <div style="z-index: 50; transform: translateY(0%); width: 100%;">
        <img src="../includes/uploads/bg-2.jpg" class="img-fluid mainimg" alt="Cart Background">
    </div>

    <div class="container my-5">
        <!-- Display notifications -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-8">
                <!-- Cart Container -->
                <div class="cart-container">
                    <div class="cart-header">
                        <h2 class="mb-0"><i class="bi bi-cart3"></i> Your Cart</h2>
                        <p class="mb-0 mt-2">Review your items before checkout</p>
                    </div>
                    
                    <!-- Cart Items Container -->
                    <div id="cartItemsContainer">
                        <!-- Items will be loaded here by JavaScript -->
                    </div>
                </div>

                <!-- Available Offers -->
                <div class="offers-section">
                    <h4 class="text-center mb-3" style="color: #BA8C63;">Available Offers</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="offer-code">
                                <strong style="color: #BA8C63;">EAT50</strong>
                                <br><small>₹50 off on ₹299+</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="offer-code">
                                <strong style="color: #BA8C63;">EAT75</strong>
                                <br><small>₹75 off on ₹399+</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="offer-code">
                                <strong style="color: #BA8C63;">EAT100</strong>
                                <br><small>₹100 off on ₹599+</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="apply-coupon mt-3">
                        <input type="text" class="form-control coupon-input" placeholder="Enter coupon code" id="couponCode">
                        <button class="btn apply-btn" onclick="applyCoupon()">Apply</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Cart Summary -->
                <div class="cart-summary">
                    <h4 style="color: #BA8C63;" class="mb-3">Order Summary</h4>
                    
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span id="subtotal">₹0.00</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Delivery Fee:</span>
                        <span id="deliveryFee">₹40.00</span>
                    </div>
                    
                    <div class="summary-row" id="discountRow" style="display: none;">
                        <span>Discount:</span>
                        <span id="discount" style="color: green;">-₹0.00</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Tax (GST 5%):</span>
                        <span id="tax">₹0.00</span>
                    </div>
                    
                    <div class="summary-row summary-total">
                        <span>Total:</span>
                        <span id="finalTotal">₹0.00</span>
                    </div>
                    
                    <form method="POST" id="checkoutForm">
                        <input type="hidden" name="cart_data" id="cartDataInput">
                        <input type="hidden" name="total_amount" id="totalAmountInput">
                        <input type="hidden" name="place_order" value="1">
                        
                        <!-- Fixed checkout button -->
                        <button type="button" class="btn checkout-btn mt-3" onclick="proceedToCheckout()">
                            <i class="bi bi-credit-card"></i> Proceed to Checkout
                        </button>
                    </form>
                    
                    <div class="text-center mt-3">
                        <a href="menu.php" class="continue-shopping">
                            <i class="bi bi-arrow-left"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || {};
        let appliedCoupon = null;
        let deliveryFee = 40;
        let taxRate = 0.05; // 5% GST

        // Load cart items and display
        function loadCartItems() {
            const container = document.getElementById('cartItemsContainer');
            
            if (Object.keys(cart).length === 0) {
                container.innerHTML = `
                    <div class="empty-cart">
                        <i class="bi bi-cart-x"></i>
                        <h3>Your cart is empty</h3>
                        <p>Add some delicious items from our menu!</p>
                        <a href="menu.php" class="btn" style="background-color: #BA8C63; color: white; border-radius: 25px; padding: 10px 30px;">
                            Browse Menu
                        </a>
                    </div>
                `;
            } else {
                let itemsHTML = '';
                
                for (let id in cart) {
                    const item = cart[id];
                    itemsHTML += `
                        <div class="cart-item" data-id="${id}">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <div class="item-image bg-light d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 10px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="mb-1">${item.name}</h5>
                                    <p class="text-muted mb-0">₹${item.price.toFixed(2)} each</p>
                                </div>
                                <div class="col-md-3">
                                    <div class="quantity-controls">
                                        <button class="quantity-btn" onclick="decreaseQuantity('${id}')">
                                            <i class="bi bi-dash"></i>
                                        </button>
                                        <input type="text" class="quantity-display" value="${item.quantity}" readonly>
                                        <button class="quantity-btn" onclick="increaseQuantity('${id}')">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-2 text-end">
                                    <strong style="color: #BA8C63;">₹${(item.price * item.quantity).toFixed(2)}</strong>
                                </div>
                                <div class="col-md-1 text-end">
                                    <i class="bi bi-trash remove-item" onclick="removeItem('${id}')"></i>
                                </div>
                            </div>
                        </div>
                    `;
                }
                
                container.innerHTML = itemsHTML;
            }
            
            updateSummary();
        }

        // Update quantity functions
        function increaseQuantity(id) {
            if (cart[id]) {
                cart[id].quantity++;
                localStorage.setItem('cart', JSON.stringify(cart));
                loadCartItems();
            }
        }

        function decreaseQuantity(id) {
            if (cart[id] && cart[id].quantity > 1) {
                cart[id].quantity--;
                localStorage.setItem('cart', JSON.stringify(cart));
                loadCartItems();
            }
        }

        function removeItem(id) {
            if (confirm('Remove this item from cart?')) {
                delete cart[id];
                localStorage.setItem('cart', JSON.stringify(cart));
                loadCartItems();
            }
        }

        // Update order summary
        function updateSummary() {
            let subtotal = 0;
            
            for (let id in cart) {
                subtotal += cart[id].price * cart[id].quantity;
            }
            
            let discount = 0;
            if (appliedCoupon) {
                if (appliedCoupon.code === 'EAT50' && subtotal >= 299) {
                    discount = 50;
                } else if (appliedCoupon.code === 'EAT75' && subtotal >= 399) {
                    discount = 75;
                } else if (appliedCoupon.code === 'EAT100' && subtotal >= 599) {
                    discount = 100;
                }
            }
            
            let deliveryFeeActual = subtotal > 0 ? deliveryFee : 0;
            let taxableAmount = subtotal - discount + deliveryFeeActual;
            let tax = taxableAmount * taxRate;
            let total = taxableAmount + tax;
            
            document.getElementById('subtotal').textContent = `₹${subtotal.toFixed(2)}`;
            document.getElementById('deliveryFee').textContent = `₹${deliveryFeeActual.toFixed(2)}`;
            document.getElementById('tax').textContent = `₹${tax.toFixed(2)}`;
            document.getElementById('finalTotal').textContent = `₹${total.toFixed(2)}`;
            
            const discountRow = document.getElementById('discountRow');
            if (discount > 0) {
                document.getElementById('discount').textContent = `-₹${discount.toFixed(2)}`;
                discountRow.style.display = 'flex';
            } else {
                discountRow.style.display = 'none';
            }
        }

        // Apply coupon
        function applyCoupon() {
            const couponCode = document.getElementById('couponCode').value.trim().toUpperCase();
            const validCoupons = ['EAT50', 'EAT75', 'EAT100'];
            
            if (validCoupons.includes(couponCode)) {
                appliedCoupon = { code: couponCode };
                updateSummary();
                alert(`Coupon ${couponCode} applied successfully!`);
                document.getElementById('couponCode').value = '';
            } else {
                alert('Invalid coupon code!');
            }
        }

        // Proceed to checkout - FIXED FUNCTION
        function proceedToCheckout() {
            if (Object.keys(cart).length === 0) {
                alert('Your cart is empty!');
                return;
            }
            
            <?php if (!$user_logged_in): ?>
                if (confirm('You need to login to place an order. Redirect to login page?')) {
                    // Store cart in localStorage before redirect
                    localStorage.setItem('cart', JSON.stringify(cart));
                    window.location.href = 'login.php';
                }
                return;
            <?php endif; ?>
            
            // Calculate final total
            let subtotal = 0;
            for (let id in cart) {
                subtotal += cart[id].price * cart[id].quantity;
            }
            
            let discount = 0;
            if (appliedCoupon) {
                if (appliedCoupon.code === 'EAT50' && subtotal >= 299) discount = 50;
                else if (appliedCoupon.code === 'EAT75' && subtotal >= 399) discount = 75;
                else if (appliedCoupon.code === 'EAT100' && subtotal >= 599) discount = 100;
            }
            
            let deliveryFeeActual = subtotal > 0 ? deliveryFee : 0;
            let taxableAmount = subtotal - discount + deliveryFeeActual;
            let tax = taxableAmount * taxRate;
            let total = taxableAmount + tax;
            
            // Validate minimum order amount
            if (subtotal < 50) {
                alert('Minimum order amount is ₹50');
                return;
            }
            
            document.getElementById('cartDataInput').value = JSON.stringify(cart);
            document.getElementById('totalAmountInput').value = total.toFixed(2);
            
            if (confirm(`Place order for ₹${total.toFixed(2)}?\n\nOrder will be processed and you will receive confirmation.`)) {
                // Show loading state
                const checkoutBtn = document.querySelector('.checkout-btn');
                checkoutBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Processing...';
                checkoutBtn.disabled = true;
                
                // Clear cart from localStorage since we're placing the order
                localStorage.removeItem('cart');
                
                document.getElementById('checkoutForm').submit();
            }
        }

        // Initialize cart on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadCartItems();
        });
    </script>

    <?php require('footer.php') ?>
</body>
</html>