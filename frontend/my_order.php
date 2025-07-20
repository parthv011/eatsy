<?php
require('header.php');
require('../includes/db.php');
session_start();

// Simulate user login (replace with your actual session logic)
$userId = $_SESSION['user_id'] ?? 0;
if (!$userId) {
    header("Location: login.php");
    exit;
}

// Get all orders for this user
$orderQuery = "SELECT * FROM orders WHERE user_id = $userId ORDER BY ordered_at DESC";
$orderResult = mysqli_query($conn, $orderQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Orders</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    .order-card {
        background: #fff;
        border-radius: 10px;
        margin-bottom: 30px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        padding: 20px;
    }
    .order-header {
        margin-bottom: 15px;
    }
    .order-item {
        border-top: 1px solid #eee;
        padding: 15px 0;
    }
    .item-image {
        width: 60px;
        height: 60px;
        border-radius: 5px;
        object-fit: cover;
    }
    .status-badge {
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 20px;
        color: #fff;
    }
    .status-pending {
        background-color: #ffc107;
    }
    .status-on_way {
        background-color: #17a2b8;
    }
    .status-delivered {
        background-color: #28a745;
    }
    .status-cancelled {
        background-color: #dc3545;
    }
    .order-actions {
        padding-top: 10px;
        border-top: 1px solid #eee;
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <h2 class="mb-4">My Orders</h2>

    <?php if (mysqli_num_rows($orderResult) > 0): ?>
      <?php while ($order = mysqli_fetch_assoc($orderResult)): ?>
        <?php
          $orderId = $order['id'];
          $itemQuery = "
            SELECT oi.*, m.name AS item_name, m.image AS item_image 
            FROM order_items oi
            JOIN menu_items m ON oi.item_id = m.id
            WHERE oi.order_id = $orderId
          ";
          $itemResult = mysqli_query($conn, $itemQuery);
          $itemCount = mysqli_num_rows($itemResult);

          // Determine badge class
          $status = strtolower($order['status']);
          $badgeClass = match($status) {
            'pending' => 'status-pending',
            'on_way' => 'status-on_way',
            'delivered' => 'status-delivered',
            'cancelled' => 'status-cancelled',
            default => 'bg-secondary'
          };
        ?>

        <div class="order-card">
          <div class="order-header">
            <div class="row align-items-center">
              <div class="col-md-6">
                <h5>Order #<?= $orderId ?></h5>
                <p class="text-muted mb-0"><i class="fas fa-calendar me-1"></i> <?= date("F j, Y \\a\\t g:i A", strtotime($order['ordered_at'])) ?></p>
              </div>
              <div class="col-md-3 text-md-center">
                <span class="status-badge <?= $badgeClass ?>"><?= ucfirst($status) ?></span>
              </div>
              <div class="col-md-3 text-end">
                <h5 class="mb-0">₹<?= number_format($order['total'], 2) ?></h5>
                <small class="text-muted"><?= $itemCount ?> item(s)</small>
              </div>
            </div>
          </div>

          <?php while ($item = mysqli_fetch_assoc($itemResult)): ?>
            <div class="order-item">
              <div class="row align-items-center">
                <div class="col-2">
                  <img src="<?= htmlspecialchars($item['item_image']) ?>" class="item-image" />
                </div>
                <div class="col-6">
                  <h6><?= htmlspecialchars($item['item_name']) ?></h6>
                  <p class="text-muted mb-0 small">₹<?= $item['price'] ?> × <?= $item['quantity'] ?></p>
                </div>
                <div class="col-2 text-center">
                  x<?= $item['quantity'] ?>
                </div>
                <div class="col-2 text-end fw-bold">
                  ₹<?= number_format($item['price'] * $item['quantity'], 2) ?>
                </div>
              </div>
            </div>
          <?php endwhile; ?>

          <div class="order-actions text-end pt-2">
            <?php if ($status === 'pending'): ?>
              <button class="btn btn-sm btn-outline-danger">Cancel Order</button>
            <?php elseif ($status === 'on_way'): ?>
              <button class="btn btn-sm btn-outline-primary">Track Order</button>
            <?php elseif ($status === 'delivered'): ?>
              <button class="btn btn-sm btn-outline-success">Reorder</button>
            <?php endif; ?>
          </div>
        </div>

      <?php endwhile; ?>
    <?php else: ?>
      <div class="text-center mt-5">
        <i class="fas fa-receipt fa-3x mb-3 text-muted"></i>
        <h4>No orders yet</h4>
        <p class="text-muted">You haven't placed any orders yet. Try something delicious!</p>
        <a href="menu.php" class="btn btn-primary">Browse Menu</a>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
