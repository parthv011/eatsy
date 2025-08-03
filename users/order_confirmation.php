<?php 
session_start();
require('header.php');

// Redirect if no order
if (!isset($_SESSION['current_order'])) {
    header('Location: menu.php');
    exit;
}

$order = $_SESSION['current_order'];
// Send order confirmation email (only once)
if (!isset($_SESSION['email_sent']) && !empty($order['customer_email'])) {
    $to = $order['customer_email'];
    $subject = "Your Order #" . $order['order_id'] . " is Confirmed!";
    $message = "Hi " . $order['customer_name'] . ",\n\n" .
               "Thank you for your order at Food Paradise!\n\n" .
               "Order ID: " . $order['order_id'] . "\n" .
               "Total: ₹" . number_format($order['total'], 2) . "\n\n" .
               "We’ll notify you once it’s out for delivery.\n\n" .
               "Bon Appétit!\n- Food Paradise Team";

    $headers = "From: no-reply@foodparadise.com\r\n";

    mail($to, $subject, $message, $headers);

    // Prevent resending on refresh
    $_SESSION['email_sent'] = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            background-color: #f7ece3ff;
            min-height: 100vh;
        }
        .confirmation-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .confirmation-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .success-icon {
            color: #28a745;
            font-size: 4rem;
            margin-bottom: 20px;
        }
        .order-details {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .order-item:last-child {
            border-bottom: none;
        }
        .status-badge {
            background: #28a745;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: bold;
        }
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn-primary-custom {
            background: #e62e4a;
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
        }
        .btn-primary-custom:hover {
            background: #cf2941;
            color: white;
        }
        .timeline {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
        .timeline-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .timeline-item:last-child {
            margin-bottom: 0;
        }
        .timeline-icon {
            background: #28a745;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 0.8rem;
        }
        .timeline-icon.pending {
            background: #6c757d;
        }
    </style>
</head>
<body>

<div class="confirmation-container">
    <!-- Success Message -->
    <div class="confirmation-card">
        <i class="fas fa-check-circle success-icon"></i>
        <h2 class="text-success mb-3">Order Confirmed!</h2>
        <p class="lead">Thank you for your order. We've received your order and it's being processed.</p>
        <div class="mt-3">
            <span class="status-badge">Order Confirmed</span>
        </div>
    </div>
    
    <!-- Order Summary -->
    <div class="order-details">
        <h5 class="mb-3">Order Details</h5>
        
        <div class="detail-row">
            <strong>Order ID:</strong>
            <span><?php echo htmlspecialchars($order['order_id']); ?></span>
        </div>
        
        <div class="detail-row">
            <strong>Order Date:</strong>
            <span><?php echo date('F j, Y g:i A', strtotime($order['order_date'])); ?></span>
        </div>
        
        <div class="detail-row">
            <strong>Customer Name:</strong>
            <span><?php echo htmlspecialchars($order['customer_name']); ?></span>
        </div>
        
        <div class="detail-row">
            <strong>Phone:</strong>
            <span><?php echo htmlspecialchars($order['customer_phone']); ?></span>
        </div>
        
        <div class="detail-row">
            <strong>Email:</strong>
            <span><?php echo htmlspecialchars($order['customer_email']); ?></span>
        </div>
        
        <div class="detail-row">
            <strong>Delivery Address:</strong>
            <span><?php echo nl2br(htmlspecialchars($order['delivery_address'])); ?></span>
        </div>
        
        <div class="detail-row">
            <strong>Payment Method:</strong>
            <span>
                <?php if ($order['payment_method'] === 'cod'): ?>
                    <i class="fas fa-money-bill-wave me-1"></i>Cash on Delivery
                <?php else: ?>
                    <i class="fas fa-credit-card me-1"></i>Online Payment
                <?php endif; ?>
            </span>
        </div>
        
        <?php if (!empty($order['special_instructions'])): ?>
        <div class="detail-row">
            <strong>Special Instructions:</strong>
            <span><?php echo nl2br(htmlspecialchars($order['special_instructions'])); ?></span>
        </div>
        <?php endif; ?>
    </div>
    
    <!-- Order Items -->
    <div class="order-details">
        <h5 class="mb-3">Order Items</h5>
        
        <?php foreach ($order['items'] as $item): ?>
        <div class="order-item">
            <div class="d-flex align-items-center">
                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" 
                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;" class="me-3">
                <div>
                    <h6 class="mb-0"><?php echo htmlspecialchars($item['name']); ?></h6>
                    <small class="text-muted">Quantity: <?php echo $item['quantity']; ?> × ₹<?php echo number_format($item['price'], 2); ?></small>
                </div>
            </div>
            <span class="fw-bold">₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
        </div>
        <?php endforeach; ?>
        
        <hr class="my-3">
        
        <div class="detail-row">
            <span>Subtotal</span>
            <span>₹<?php echo number_format($order['subtotal'], 2); ?></span>
        </div>
        
        <div class="detail-row">
            <span>GST (18%)</span>
            <span>₹<?php echo number_format($order['tax'], 2); ?></span>
        </div>
        
        <div class="detail-row">
            <span>Delivery Fee</span>
            <span>
                <?php if ($order['delivery_fee'] == 0): ?>
                    <span class="text-success">FREE</span>
                <?php else: ?>
                    ₹<?php echo number_format($order['delivery_fee'], 2); ?>
                <?php endif; ?>
            </span>
        </div>
        
        <div class="detail-row">
            <strong>Total Amount</strong>
            <strong class="text-primary">₹<?php echo number_format($order['total'], 2); ?></strong>
        </div>
    </div>
    
    <!-- Order Timeline -->
    <div class="order-details">
        <h5 class="mb-3">Order Status</h5>
        
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-icon">
                    <i class="fas fa-check"></i>
                </div>
                <div>
                    <strong>Order Confirmed</strong>
                    <br><small class="text-muted">Your order has been confirmed and is being prepared</small>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-icon pending">
                    <i class="fas fa-utensils"></i>
                </div>
                <div>
                    <strong>Preparing</strong>
                    <br><small class="text-muted">Your delicious food is being prepared</small>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-icon pending">
                    <i class="fas fa-motorcycle"></i>
                </div>
                <div>
                    <strong>Out for Delivery</strong>
                    <br><small class="text-muted">Your order is on the way</small>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-icon pending">
                    <i class="fas fa-home"></i>
                </div>
                <div>
                    <strong>Delivered</strong>
                    <br><small class="text-muted">Enjoy your meal!</small>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-3">
            <small class="text-muted">
                <i class="fas fa-clock me-1"></i>
                Estimated delivery time: 30-45 minutes
            </small>
        </div>
    </div>
    
    <!-- Action Buttons -->
    <div class="text-center">
        <div class="action-buttons">
            <a href="menu.php" class="btn btn-primary-custom">
                <i class="fas fa-utensils me-2"></i>Order Again
            </a>
            <a href="order_tracking.php?order_id=<?php echo urlencode($order['order_id']); ?>" class="btn btn-outline-primary">
                <i class="fas fa-search me-2"></i>Track Order
            </a>
            <button onclick="window.print()" class="btn btn-outline-secondary">
                <i class="fas fa-print me-2"></i>Print Receipt
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php 
require('footer.php'); 
unset($_SESSION['current_order']);
unset($_SESSION['email_sent']);
?>
</body>
</html>