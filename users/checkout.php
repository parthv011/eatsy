<?php 
session_start();
require('header.php');

// Redirect if cart is empty
if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

// Calculate totals
$subtotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$tax = $subtotal * 0.18;
$delivery_fee = $subtotal > 500 ? 0 : 50;
$total = $subtotal + $tax + $delivery_fee;

// Handle form submission
if ($_POST['action'] ?? '' === 'place_order') {
    // Validate required fields
    $errors = [];
    
    if (empty($_POST['customer_name'])) $errors[] = 'Name is required';
    if (empty($_POST['customer_phone'])) $errors[] = 'Phone number is required';
    if (empty($_POST['customer_email'])) $errors[] = 'Email is required';
    if (empty($_POST['delivery_address'])) $errors[] = 'Delivery address is required';
    if (empty($_POST['payment_method'])) $errors[] = 'Payment method is required';
    
    if (empty($errors)) {
        // Generate order ID
        $order_id = 'ORD' . date('Ymd') . rand(1000, 9999);
        
        // Store order in session (you can save to database here)
        $_SESSION['current_order'] = [
            'order_id' => $order_id,
            'customer_name' => $_POST['customer_name'],
            'customer_phone' => $_POST['customer_phone'],
            'customer_email' => $_POST['customer_email'],
            'delivery_address' => $_POST['delivery_address'],
            'payment_method' => $_POST['payment_method'],
            'special_instructions' => $_POST['special_instructions'] ?? '',
            'items' => $_SESSION['cart'],
            'subtotal' => $subtotal,
            'tax' => $tax,
            'delivery_fee' => $delivery_fee,
            'total' => $total,
            'order_date' => date('Y-m-d H:i:s'),
            'status' => 'confirmed'
        ];
        
        // Clear cart
        $_SESSION['cart'] = [];
        
        // Redirect to confirmation
        header('Location: order_confirmation.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            background-color: #f7ece3ff;
            min-height: 100vh;
        }
        .checkout-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .checkout-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .order-summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .order-summary-item:last-child {
            border-bottom: none;
        }
        .payment-option {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .payment-option:hover {
            border-color: #e62e4a;
        }
        .payment-option.selected {
            border-color: #e62e4a;
            background-color: #fff5f5;
        }
        .place-order-btn {
            background: #e62e4a;
            border: none;
            color: white;
            padding: 15px 0;
            border-radius: 8px;
            font-weight: bold;
            font-size: 1.2rem;
            width: 100%;
        }
        .place-order-btn:hover {
            background: #cf2941;
        }
        .section-title {
            color: #333;
            border-bottom: 2px solid #e62e4a;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="checkout-container">
    <div class="row">
        <div class="col-lg-8">
            <h2 class="mb-4">Checkout</h2>
            
            <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            
            <form method="POST">
                <input type="hidden" name="action" value="place_order">
                
                <!-- Customer Information -->
                <div class="checkout-section">
                    <h5 class="section-title">Customer Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="customer_name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" 
                                   value="<?php echo htmlspecialchars($_POST['customer_name'] ?? ''); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="customer_phone" class="form-label">Phone Number *</label>
                            <input type="tel" class="form-control" id="customer_phone" name="customer_phone" 
                                   value="<?php echo htmlspecialchars($_POST['customer_phone'] ?? ''); ?>" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="customer_email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control" id="customer_email" name="customer_email" 
                                   value="<?php echo htmlspecialchars($_POST['customer_email'] ?? ''); ?>" required>
                        </div>
                    </div>
                </div>
                
                <!-- Delivery Information -->
                <div class="checkout-section">
                    <h5 class="section-title">Delivery Information</h5>
                    <div class="mb-3">
                        <label for="delivery_address" class="form-label">Delivery Address *</label>
                        <textarea class="form-control" id="delivery_address" name="delivery_address" rows="3" required><?php echo htmlspecialchars($_POST['delivery_address'] ?? ''); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="special_instructions" class="form-label">Special Instructions</label>
                        <textarea class="form-control" id="special_instructions" name="special_instructions" rows="2" 
                                  placeholder="Any special requests or delivery instructions..."><?php echo htmlspecialchars($_POST['special_instructions'] ?? ''); ?></textarea>
                    </div>
                </div>
                
                <!-- Payment Method -->
                <div class="checkout-section">
                    <h5 class="section-title">Payment Method</h5>
                    <div class="payment-option" onclick="selectPayment('cod')">
                        <div class="d-flex align-items-center">
                            <input type="radio" name="payment_method" value="cod" id="cod" class="me-3" 
                                   <?php echo ($_POST['payment_method'] ?? '') === 'cod' ? 'checked' : ''; ?>>
                            <div>
                                <h6 class="mb-1"><i class="fas fa-money-bill-wave me-2"></i>Cash on Delivery</h6>
                                <small class="text-muted">Pay when your order arrives</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="payment-option" onclick="selectPayment('online')">
                        <div class="d-flex align-items-center">
                            <input type="radio" name="payment_method" value="online" id="online" class="me-3"
                                   <?php echo ($_POST['payment_method'] ?? '') === 'online' ? 'checked' : ''; ?>>
                            <div>
                                <h6 class="mb-1"><i class="fas fa-credit-card me-2"></i>Online Payment</h6>
                                <small class="text-muted">Pay now with UPI, Card, or Net Banking</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn place-order-btn">
                    <i class="fas fa-check-circle me-2"></i>Place Order
                </button>
            </form>
        </div>
        
        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="checkout-section position-sticky" style="top: 20px;">
                <h5 class="section-title">Order Summary</h5>
                
                <!-- Cart Items -->
                <div class="mb-3">
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="order-summary-item">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" 
                                 style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px;" class="me-2">
                            <div>
                                <h6 class="mb-0 small"><?php echo htmlspecialchars($item['name']); ?></h6>
                                <small class="text-muted">Qty: <?php echo $item['quantity']; ?></small>
                            </div>
                        </div>
                        <span class="fw-bold">₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <hr>
                
                <!-- Price Breakdown -->
                <div class="order-summary-item">
                    <span>Subtotal</span>
                    <span>₹<?php echo number_format($subtotal, 2); ?></span>
                </div>
                
                <div class="order-summary-item">
                    <span>GST (18%)</span>
                    <span>₹<?php echo number_format($tax, 2); ?></span>
                </div>
                
                <div class="order-summary-item">
                    <span>Delivery Fee</span>
                    <span>
                        <?php if ($delivery_fee == 0): ?>
                            <span class="text-success">FREE</span>
                        <?php else: ?>
                            ₹<?php echo number_format($delivery_fee, 2); ?>
                        <?php endif; ?>
                    </span>
                </div>
                
                <hr>
                
                <div class="order-summary-item">
                    <strong>Total</strong>
                    <strong class="text-primary">₹<?php echo number_format($total, 2); ?></strong>
                </div>
                
                <div class="mt-3 text-center">
                    <small class="text-muted">
                        <i class="fas fa-clock me-1"></i>
                        Estimated delivery: 30-45 minutes
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function selectPayment(method) {
    // Remove selected class from all options
    document.querySelectorAll('.payment-option').forEach(option => {
        option.classList.remove('selected');
    });
    
    // Add selected class to clicked option
    event.currentTarget.classList.add('selected');
    
    // Check the radio button
    document.getElementById(method).checked = true;
}

// Initialize selected payment method
document.addEventListener('DOMContentLoaded', function() {
    const checkedRadio = document.querySelector('input[name="payment_method"]:checked');
    if (checkedRadio) {
        checkedRadio.closest('.payment-option').classList.add('selected');
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php require('footer.php'); ?>
</body>
</html>