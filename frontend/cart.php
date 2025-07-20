<?php require('header.php')?>
<?php require('../backend/cart.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Cart - TastyBites</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            /* --primary-color: #ff6b35; */
            --secondary-color: #2c3e50;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
        }

        body {
            background-color: #f7ece3ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color), #e55a2b);
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }

        .cart-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .cart-header {
            background: linear-gradient(135deg, var(--secondary-color), #34495e);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .cart-item {
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
            transition: all 0.3s ease;
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .item-details h6 {
            color: var(--secondary-color);
            font-weight: 600;
            margin-bottom: 5px;
        }

        .item-description {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .item-options {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
        }

        .option-badge {
            background: #e3f2fd;
            color: #1976d2;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8f9fa;
            border-radius: 25px;
            padding: 5px;
            width: fit-content;
        }

        .quantity-btn {
            width: 35px;
            height: 35px;
            border: none;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--primary-color);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .quantity-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        .quantity-display {
            min-width: 40px;
            text-align: center;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .item-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .remove-btn {
            background: none;
            border: none;
            color: var(--danger-color);
            padding: 8px;
            border-radius: 50%;
            transition: all 0.2s;
        }

        .remove-btn:hover {
            background: rgba(231, 76, 60, 0.1);
            transform: scale(1.1);
        }

        .summary-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 25px;
            position: sticky;
            top: 20px;
        }

        .summary-header {
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            padding: 5px 0;
        }

        .summary-row.total {
            border-top: 2px solid #e9ecef;
            padding-top: 15px;
            margin-top: 15px;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .discount-section {
            background: #f0f8ff;
            border: 1px solid #b3d9ff;
            border-radius: 10px;
            padding: 15px;
            margin: 20px 0;
        }

        .promo-input {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .apply-btn {
            background: var(--success-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .apply-btn:hover {
            background: #2ecc71;
            transform: translateY(-2px);
        }

        .checkout-btn {
            background: linear-gradient(135deg, var(--primary-color), #e55a2b);
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .checkout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 107, 53, 0.4);
            color: white;
        }

        .delivery-info {
            background: #e8f5e8;
            border: 1px solid #c3e6c3;
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
            text-align: center;
        }

        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-cart i {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 20px;
        }

        .continue-shopping {
            background: var(--secondary-color);
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .continue-shopping:hover {
            background: #34495e;
            color: white;
            transform: translateY(-2px);
        }

        .badge-notification {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--danger-color);
            color: white;
            border-radius: 50%;
            padding: 4px 8px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .special-offer {
            background: linear-gradient(135deg, #ffeaa7, #fdcb6e);
            border-radius: 10px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
        }

        @media (max-width: 768px) {
            .cart-item {
                padding: 15px;
            }
            
            .item-image {
                width: 60px;
                height: 60px;
            }
            
            .quantity-controls {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <div class="row">
            <!-- Cart Items Section -->
            <div class="col-lg-8">
                <div class="cart-container">
                    <div class="cart-header">
                        <h3 class="mb-0">
                            <i class="fas fa-shopping-cart me-2"></i>Your Food Cart
                        </h3>
                        <p class="mb-0 mt-2">Review your delicious selections</p>
                    </div>

                    <div id="cart-items"></div>

                <!-- Continue Shopping Button -->
                <div class="text-center mt-4">
                    <a href="menu.php" class="continue-shopping">
                        <i class="fas fa-arrow-right me-2"></i>Continue 
                    </a>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div class="col-lg-4">
                <div class="summary-card">
                    <div class="summary-header">
                        <h5 class="mb-0">
                            <i class="fas fa-receipt me-2"></i>Order Summary
                        </h5>
                    </div>

                    <div class="summary-row">
                        <span>Subtotal (<span id="item-count">4</span> items)</span>
                        <span>$<span id="subtotal">45.47</span></span>
                    </div>

                    <div class="summary-row">
                        <span>
                            <i class="fas fa-truck me-1"></i>Delivery Fee
                        </span>
                        <span>$<span id="delivery-fee">2.99</span></span>
                    </div>

                    <div class="summary-row">
                        <span>
                            <i class="fas fa-percentage me-1"></i>Tax & Fees
                        </span>
                        <span>$<span id="tax">3.64</span></span>
                    </div>

                    <div class="summary-row" id="discount-row" style="display: none;">
                        <span class="text-success">
                            <i class="fas fa-tag me-1"></i>Discount
                        </span>
                        <span class="text-success">-$<span id="discount">0.00</span></span>
                    </div>

                    <div class="summary-row total">
                        <span>Total</span>
                        <span>$<span id="total">52.10</span></span>
                    </div>

                    <!-- Promo Code Section -->
                    <div class="discount-section">
                        <h6 class="mb-3">
                            <i class="fas fa-tag me-2"></i>Have a promo code?
                        </h6>
                        <div class="input-group">
                            <input type="text" class="form-control promo-input" id="promo-code" placeholder="Enter promo code">
                            <button class="btn apply-btn" onclick="applyPromoCode()">
                                <i class="fas fa-check me-1"></i>Apply
                            </button>
                        </div>
                    </div>

                    <!-- Special Offer -->
                    <div class="special-offer">
                        <h6 class="mb-2">
                            <i class="fas fa-gift me-2"></i>Special Offer!
                        </h6>
                        <p class="mb-0">Free delivery on orders over $50!</p>
                    </div>

                    <!-- Checkout Button -->
                    <button class="checkout-btn" onclick="proceedToCheckout()">
                        <i class="fas fa-credit-card me-2"></i>Checkout Now
                    </button>

                    <!-- Place Order Button -->
<form action="../backend/place_order.php" method="POST" class="mt-3 text-center">
    <button type="submit" class="btn btn-success w-100 mb-2">
        <i class="fas fa-check-circle me-2"></i>Place Order
    </button>
    <a href="menu.php" class="btn btn-outline-primary w-100">
        <i class="fas fa-arrow-left me-2"></i>Continue Shopping
    </a>
</form>

                    <!-- Delivery Information -->
                    <div class="delivery-info">
                        <h6 class="mb-2">
                            <i class="fas fa-clock me-2"></i>Delivery Information
                        </h6>
                        <p class="mb-1">
                            <strong>Estimated Time:</strong> 25-35 minutes
                        </p>
                        <p class="mb-0">
                            <strong>Address:</strong> 123 Food Street, City
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Empty Cart State (Hidden by default) -->
    <div id="empty-cart" class="container mt-5 d-none">
        <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <h3>Your cart is empty</h3>
            <p>Looks like you haven't added any delicious items to your cart yet.</p>
            <a href="#" class="btn btn-primary btn-lg">
                <i class="fas fa-utensils me-2"></i>Browse Menu
            </a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Item data
        const items = {
            1: { name: "Margherita Pizza", price: 12.49, quantity: 2 },
            2: { name: "Paneer Capsicum", price: 11.99, quantity: 1 },
            3: { name: "Caesar Salad", price: 8.50, quantity: 1 }
        };

        // Promo codes
        const promoCodes = {
            'SAVE10': 0.10,
            'WELCOME20': 0.20,
            'FOOD15': 0.15
        };

        let appliedDiscount = 0;

        function updateQuantity(itemId, change) {
            const item = items[itemId];
            if (!item) return;

            const newQuantity = item.quantity + change;
            if (newQuantity < 1) return;

            item.quantity = newQuantity;
            
            // Update quantity display
            document.getElementById(`qty-${itemId}`).textContent = newQuantity;
            
            // Update item price
            const newPrice = (item.price * newQuantity).toFixed(2);
            document.getElementById(`price-${itemId}`).textContent = newPrice;
            
            updateSummary();
        }

        function removeItem(itemId) {
            const itemElement = document.querySelector(`[data-item-id="${itemId}"]`);
            if (itemElement) {
                itemElement.remove();
                delete items[itemId];
                updateSummary();
                updateCartBadge();
                
                // Check if cart is empty
                if (Object.keys(items).length === 0) {
                    showEmptyCart();
                }
            }
        }

        function updateSummary() {
            let subtotal = 0;
            let itemCount = 0;
            
            // Calculate subtotal and item count
            Object.values(items).forEach(item => {
                subtotal += item.price * item.quantity;
                itemCount += item.quantity;
            });
            
            const deliveryFee = subtotal >= 50 ? 0 : 2.99;
            const taxRate = 0.08;
            const tax = subtotal * taxRate;
            const discount = subtotal * appliedDiscount;
            const total = subtotal + deliveryFee + tax - discount;
            
            // Update DOM
            document.getElementById('subtotal').textContent = subtotal.toFixed(2);
            document.getElementById('item-count').textContent = itemCount;
            document.getElementById('delivery-fee').textContent = deliveryFee.toFixed(2);
            document.getElementById('tax').textContent = tax.toFixed(2);
            document.getElementById('discount').textContent = discount.toFixed(2);
            document.getElementById('total').textContent = total.toFixed(2);
            
            // Show/hide discount row
            const discountRow = document.getElementById('discount-row');
            if (appliedDiscount > 0) {
                discountRow.style.display = 'flex';
            } else {
                discountRow.style.display = 'none';
            }
            
            // Update special offer visibility
            updateSpecialOffer(subtotal);
        }

        function updateSpecialOffer(subtotal) {
            const specialOffer = document.querySelector('.special-offer');
            if (subtotal >= 50) {
                specialOffer.innerHTML = `
                    <h6 class="mb-2"><i class="fas fa-check-circle me-2"></i>Congratulations!</h6>
                    <p class="mb-0">You've earned free delivery!</p>
                `;
                specialOffer.style.background = 'linear-gradient(135deg, #d4edda, #c3e6cb)';
            } else {
                const remaining = (50 - subtotal).toFixed(2);
                specialOffer.innerHTML = `
                    <h6 class="mb-2"><i class="fas fa-gift me-2"></i>Special Offer!</h6>
                    <p class="mb-0">Add $${remaining} more for free delivery!</p>
                `;
                specialOffer.style.background = 'linear-gradient(135deg, #ffeaa7, #fdcb6e)';
            }
        }

        function updateCartBadge() {
            const itemCount = Object.values(items).reduce((sum, item) => sum + item.quantity, 0);
            document.getElementById('cart-badge').textContent = itemCount;
        }

        function applyPromoCode() {
            const promoInput = document.getElementById('promo-code');
            const code = promoInput.value.toUpperCase();
            
            if (promoCodes[code]) {
                appliedDiscount = promoCodes[code];
                updateSummary();
                
                // Show success message
                promoInput.style.borderColor = '#28a745';
                promoInput.value = `${code} Applied!`;
                promoInput.disabled = true;
                
                // Change button text
                const applyBtn = document.querySelector('.apply-btn');
                applyBtn.innerHTML = '<i class="fas fa-check me-1"></i>Applied';
                applyBtn.style.background = '#28a745';
                applyBtn.disabled = true;
            } else {
                // Show error
                promoInput.style.borderColor = '#dc3545';
                promoInput.placeholder = 'Invalid code';
                promoInput.value = '';
                
                setTimeout(() => {
                    promoInput.style.borderColor = '#dee2e6';
                    promoInput.placeholder = 'Enter promo code';
                }, 3000);
            }
        }

        function proceedToCheckout() {
            // Simulate checkout process
            const checkoutBtn = document.querySelector('.checkout-btn');
            checkoutBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
            checkoutBtn.disabled = true;
            
            setTimeout(() => {
                alert('Redirecting to secure checkout...');
                checkoutBtn.innerHTML = '<i class="fas fa-credit-card me-2"></i>Checkout Now';
                checkoutBtn.disabled = false;
            }, 2000);
        }

        function showEmptyCart() {
            document.querySelector('.container .row').style.display = 'none';
            document.getElementById('empty-cart').classList.remove('d-none');
        }

        // Initialize
        updateSummary();
        updateCartBadge();
    </script>
</body>
</html>