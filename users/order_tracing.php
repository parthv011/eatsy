<?php 
session_start();
require('header.php');

$order = null;
$order_id = $_GET['order_id'] ?? '';

// For demo purposes, check if order exists in session
if ($order_id && isset($_SESSION['current_order']) && $_SESSION['current_order']['order_id'] === $order_id) {
    $order = $_SESSION['current_order'];
    
    // Simulate order progress based on time
    $order_time = strtotime($order['order_date']);
    $current_time = time();
    $elapsed_minutes = ($current_time - $order_time) / 60;
    
    if ($elapsed_minutes < 5) {
        $status = 'confirmed';
        $status_text = 'Order Confirmed';
    } elseif ($elapsed_minutes < 20) {
        $status = 'preparing';
        $status_text = 'Preparing';
    } elseif ($elapsed_minutes < 35) {
        $status = 'out_for_delivery';
        $status_text = 'Out for Delivery';
    } else {
        $status = 'delivered';
        $status_text = 'Delivered';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            background-color: #f7ece3ff;
            min-height: 100vh;
        }
        .tracking-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .tracking-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .search-form {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .tracking-timeline {
            position: relative;
            padding: 20px 0;
        }
        .timeline-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
            position: relative;
        }
        .timeline-item:last-child {
            margin-bottom: 0;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 24px;
            top: 50px;
            width: 2px;
            height: calc(100% + 10px);
            background: #e9ecef;
            z-index: 1;
        }
        .timeline-item:last-child::before {
            display: none;
        }
        .timeline-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-right: 20px;
            position: relative;
            z-index: 2;
            border: 3px solid #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .timeline-icon.active {
            background: #28a745;
            color: white;
        }
        .timeline-icon.current {
            background: #e62e4a;
            color: white;
            animation: pulse 2s infinite;
        }
        .timeline-icon.pending {
            background: #e9ecef;
            color: #6c757d;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        .timeline-content h5 {
            margin-bottom: 5px;
            color: #333;
        }
        .timeline-content p {
            margin-bottom: 0;
            color: #666;
        }
        .timeline-content .time {
            color: #999;
            font-size: 0.9rem;
        }
        .order-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .delivery-info {
            background: #e8f5e8;
            border: 1px solid #28a745;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }
        .btn-primary-custom {
            background: #e62e4a;
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: bold;
        }
        .btn-primary-custom:hover {
            background: #cf2941;
        }
    </style>
</head>
<body>

<div class="tracking-container">
    <h2 class="text-center mb-4">Track Your Order</h2>
    
    <?php if (!$order): ?>
    <!-- Search Form -->
    <div class="search-form">
        <h5 class="mb-3">Enter Order Details</h5>
        <form method="GET">
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="order_id" class="form-label">Order ID</label>
                    <input type="text" class="form-control" id="order_id" name="order_id" 
                           placeholder="Enter your order ID (e.g., ORD20240101234)"
                           value="<?php echo htmlspecialchars($order_id); ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary-custom w-100">
                        <i class="fas fa-search me-2"></i>Track Order
                    </button>
                </div>
            </div>
        </form>
        
        <?php if ($order_id && !$order): ?>
        <div class="alert alert-warning mt-3">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Order not found. Please check your order ID and try again.
        </div>
        <?php endif; ?>
        
        <div class="mt-3">
            <small class="text-muted">
                <i class="fas fa-info-circle me-1"></i>
                You can find your order ID in the confirmation email or receipt.
            </small>
        </div>
    </div>
    <?php else: ?>
    
    <!-- Order Found -->
    <div class="tracking-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1">Order #<?php echo htmlspecialchars($order['order_id']); ?></h4>
                <p class="text-muted mb-0">Placed on <?php echo date('F j, Y g:i A', strtotime($order['order_date'])); ?></p>
            </div>
            <div class="text-end">
                <span class="badge bg-success fs-6"><?php echo $status_text; ?></span>
            </div>
        </div>
        
        <!-- Order Info -->
        <div class="order-info">
            <div class="row">
                <div class="col-md-6">
                    <strong>Customer:</strong> <?php echo htmlspecialchars($order['customer_name']); ?><br>
                    <strong>Phone:</strong> <?php echo htmlspecialchars($order['customer_phone']); ?>
                </div>
                <div class="col-md-6">
                    <strong>Total Amount:</strong> ₹<?php echo number_format($order['total'], 2); ?><br>
                    <strong>Payment:</strong> 
                    <?php if ($order['payment_method'] === 'cod'): ?>
                        Cash on Delivery
                    <?php else: ?>
                        Online Payment
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Delivery Address -->
        <div class="mb-4">
            <h6><i class="fas fa-map-marker-alt me-2"></i>Delivery Address</h6>
            <p class="ms-4 mb-0"><?php echo nl2br(htmlspecialchars($order['delivery_address'])); ?></p>
        </div>
        
        <!-- Tracking Timeline -->
        <div class="tracking-timeline">
            <div class="timeline-item">
                <div class="timeline-icon <?php echo $status === 'confirmed' ? 'current' : 'active'; ?>">
                    <i class="fas fa-check"></i>
                </div>
                <div class="timeline-content">
                    <h5>Order Confirmed</h5>
                    <p>Your order has been confirmed and received.</p>
                    <div class="time"><?php echo date('g:i A', strtotime($order['order_date'])); ?></div>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-icon <?php echo $status === 'preparing' ? 'current' : ($status === 'confirmed' ? 'pending' : 'active'); ?>">
                    <i class="fas fa-utensils"></i>
                </div>
                <div class="timeline-content">
                    <h5>Preparing Your Order</h5>
                    <p>Our chefs are preparing your delicious meal.</p>
                    <?php if (in_array($status, ['preparing', 'out_for_delivery', 'delivered'])): ?>
                    <div class="time"><?php echo date('g:i A', strtotime($order['order_date']) + (5 * 60)); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-icon <?php echo $status === 'out_for_delivery' ? 'current' : (in_array($status, ['confirmed', 'preparing']) ? 'pending' : 'active'); ?>">
                    <i class="fas fa-motorcycle"></i>
                </div>
                <div class="timeline-content">
                    <h5>Out for Delivery</h5>
                    <p>Your order is on the way to your location.</p>
                    <?php if (in_array($status, ['out_for_delivery', 'delivered'])): ?>
                    <div class="time"><?php echo date('g:i A', strtotime($order['order_date']) + (20 * 60)); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="timeline-icon <?php echo $status === 'delivered' ? 'active' : 'pending'; ?>">
                    <i class="fas fa-home"></i>
                </div>
                <div class="timeline-content">
                    <h5>Delivered</h5>
                    <p>Your order has been delivered. Enjoy your meal!</p>
                    <?php if ($status === 'delivered'): ?>
                    <div class="time"><?php echo date('g:i A', strtotime($order['order_date']) + (35 * 60)); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Delivery Estimate -->
        <?php if ($status !== 'delivered'): ?>
        <div class="delivery-info">
            <h6><i class="fas fa-clock me-2"></i>Estimated Delivery Time</h6>
            <p class="mb-0">
                <?php
                $remaining_time = 45 - $elapsed_minutes;
                if ($remaining_time > 0) {
                    echo "Approximately " . ceil($remaining_time) . " minutes remaining";
                } else {
                    echo "Should arrive any moment now!";
                }
                ?>
            </p>
        </div>
        <?php endif; ?>
        
        <!-- Action Buttons -->
        <div class="text-center mt-4">
            <a href="menu.php" class="btn btn-primary-custom me-2">
                <i class="fas fa-utensils me-2"></i>Order Again
            </a>
            <?php if ($status !== 'delivered'): ?>
            <button onclick="location.reload()" class="btn btn-outline-primary">
                <i class="fas fa-sync-alt me-2"></i>Refresh Status
            </button>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
// Auto-refresh page every 30 seconds if order is being tracked
<?php if ($order && $status !== 'delivered'): ?>
setTimeout(function() {
    location.reload();
}, 30000);
<?php endif; ?>
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php require('footer.php'); ?>
</body>
</html>