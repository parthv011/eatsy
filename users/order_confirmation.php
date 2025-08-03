<?php 
session_start();
require('header.php');
require_once '../includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get order ID from URL
$order_id = intval($_GET['order_id'] ?? 0);

if ($order_id <= 0) {
    header('Location: menu.php');
    exit;
}

// Fetch order details
$stmt = $conn->prepare("
    SELECT o.*, u.name as customer_name, u.email as customer_email 
    FROM orders o 
    JOIN users u ON o.user_id = u.id 
    WHERE o.id = ? AND o.user_id = ?
");
$stmt->bind_param("ii", $order_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = "Order not found.";
    header('Location: menu.php');
    exit;
}

$order = $result->fetch_assoc();
$stmt->close();

// Fetch order items
$stmt = $conn->prepare("
    SELECT oi.*, mi.name as item_name, mi.image as item_image 
    FROM order_items oi 
    JOIN menu_items mi ON oi.item_id = mi.id 
    WHERE oi.order_id = ?
");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$items_result = $stmt->get_result();

$order_items = [];
while ($row = $items_result->fetch_assoc()) {
    $order_items[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Food Delivery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            background-color: #f7ece3ff;
        }

        .confirmation-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            margin: 2rem 0;
        }

        .confirmation-header {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }

        .success-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            animation: bounceIn 1s ease-out;
        }

        @keyframes bounceIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .order-details {
            padding: 2rem;
        }

        .order-info-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 1rem;
        }

        .status-badge {
            background-color: #ffc107;
            color: #000;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: bold;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #BA8C63, #a67c56);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(186, 140, 99, 0.4);
        }

        .estimated-time {
            background: linear-gradient(135deg, #BA8C63, #a67c56);
            color: white;
            padding: 1rem;
            border-radius: 10px;
            text-align: center;
            margin: 1rem 0;
        }

        .tracking-steps {
            display: flex;
            justify-content: space-between;
            margin: 2rem 0;
            position: relative;
        }

        .tracking-step {
            text-align: center;
            flex: 1;
            position: relative;
        }

        .tracking-step.active .step-circle {
            background-color: #28a745;
            color: white;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            font-weight: bold;
        }

        .tracking-line {
            position: absolute;
            top: 20px;
            left: 50%;
            right: -50%;
            height: 2px;
            background-color: #e9ecef;
            z-index: -1;
        }

        .tracking-step.active .tracking-line {
            background-color: #28a745;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="confirmation-container">
                    <!-- Success Header -->
                    <div class="confirmation-header">
                        <div class="success-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h1 class="mb-3">Order Confirmed!</h1>
                        <p class="lead mb-0">Thank you for your order. We're preparing your delicious meal!</p>
                    </div>

                    <!-- Order Details -->
                    <div class="order-details">
                        <!-- Order Info -->
                        <div class="order-info-card">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 style="color: #BA8C63;"><i class="bi bi-receipt"></i> Order Details</h5>
                                    <p><strong>Order ID:</strong> #<?= $order['id'] ?></p>
                                    <p><strong>Order Date:</strong> <?= date('M d, Y - h:i A', strtotime($order['ordered_at'])) ?></p>
                                    <p><strong>Status:</strong> <span class="status-badge"><?= ucfirst($order['status']) ?></span></p>
                                </div>
                                <div class="col-md-6">
                                    <h5 style="color: #BA8C63;"><i class="bi bi-person"></i> Customer Info</h5>
                                    <p><strong>Name:</strong> <?= htmlspecialchars($order['customer_name']) ?></p>
                                    <p><strong>Email:</strong> <?= htmlspecialchars($order['customer_email']) ?></p>
                                    <p><strong>Total Amount:</strong> <strong style="color: #BA8C63; font-size: 1.2rem;">₹<?= number_format($order['total'], 2) ?></strong></p>
                                </div>
                            </div>
                        </div>

                        <!-- Estimated Delivery Time -->
                        <div class="estimated-time">
                            <h5 class="mb-2"><i class="bi bi-clock"></i> Estimated Delivery Time</h5>
                            <h3 class="mb-0">30 - 45 minutes</h3>
                            <small>We'll notify you when your order is on the way!</small>
                        </div>

                        <!-- Order Tracking -->
                        <div class="tracking-steps">
                            <div class="tracking-step active">
                                <div class="step-circle">1</div>
                                <small>Order Confirmed</small>
                                <div class="tracking-line"></div>
                            </div>
                            <div class="tracking-step">
                                <div class="step-circle">2</div>
                                <small>Preparing</small>
                                <div class="tracking-line"></div>
                            </div>
                            <div class="tracking-step">
                                <div class="step-circle">3</div>
                                <small>Out for Delivery</small>
                                <div class="tracking-line"></div>
                            </div>
                            <div class="tracking-step">
                                <div class="step-circle">4</div>
                                <small>Delivered</small>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="order-info-card">
                            <h5 style="color: #BA8C63;" class="mb-3"><i class="bi bi-bag"></i> Your Items</h5>
                            <?php foreach ($order_items as $item): ?>
                                <div class="order-item">
                                    <div class="item-image bg-light d-flex align-items-center justify-content-center">
                                        <?php if ($item['item_image'] && file_exists($item['item_image'])): ?>
                                            <img src="<?= htmlspecialchars($item['item_image']) ?>" alt="<?= htmlspecialchars($item['item_name']) ?>" class="item-image">
                                        <?php else: ?>
                                            <i class="bi bi-image text-muted"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1"><?= htmlspecialchars($item['item_name']) ?></h6>
                                        <small class="text-muted">Quantity: <?= $item['quantity'] ?></small>
                                    </div>
                                    <div class="text-end">
                                        <strong style="color: #BA8C63;">₹<?= number_format($item['price'] * $item['quantity'], 2) ?></strong>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="menu.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Continue Shopping
                            </a>
                            <a href="my_orders.php" class="btn btn-primary-custom">
                                <i class="bi bi-list-ul"></i> View All Orders
                            </a>
                        </div>

                        <!-- Additional Info -->
                        <div class="text-center mt-4 p-3" style="background: #e8f5e8; border-radius: 10px;">
                            <h6 style="color: #28a745;"><i class="bi bi-info-circle"></i> What's Next?</h6>
                            <p class="mb-0 small">
                                You will receive SMS/Email updates about your order status. 
                                Our delivery partner will contact you when your order is on the way.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Optional: Auto-refresh order status -->
    <script>
        // Clear localStorage cart after successful order
        localStorage.removeItem('cart');
        
        // Optional: Simulate order progress (for demo)
        setTimeout(() => {
            const steps = document.querySelectorAll('.tracking-step');
            if (steps.length > 1) {
                steps[1].classList.add('active');
            }
        }, 5000); // After 5 seconds, mark as "Preparing"
    </script>

    <?php require('footer.php') ?>
</body>
</html>