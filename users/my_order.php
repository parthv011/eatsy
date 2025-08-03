<?php 
session_start();
require('header.php');
require_once '../includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle order cancellation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order'])) {
    $order_id = intval($_POST['order_id']);
    
    // Check if order belongs to user and can be cancelled
    $stmt = $conn->prepare("SELECT status FROM orders WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $order_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        if ($order['status'] === 'Pending') {
            $update_stmt = $conn->prepare("UPDATE orders SET status = 'Cancelled' WHERE id = ?");
            $update_stmt->bind_param("i", $order_id);
            if ($update_stmt->execute()) {
                $_SESSION['success'] = "Order #$order_id has been cancelled successfully.";
            } else {
                $_SESSION['error'] = "Failed to cancel order.";
            }
            $update_stmt->close();
        } else {
            $_SESSION['error'] = "Order cannot be cancelled as it's already " . strtolower($order['status']) . ".";
        }
    }
    $stmt->close();
    
    header("Location: my_orders.php");
    exit;
}

// Pagination
$page = intval($_GET['page'] ?? 1);
$per_page = 10;
$offset = ($page - 1) * $per_page;

// Get total orders count
$count_stmt = $conn->prepare("SELECT COUNT(*) as total FROM orders WHERE user_id = ?");
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$total_orders = $count_stmt->get_result()->fetch_assoc()['total'];
$count_stmt->close();

$total_pages = ceil($total_orders / $per_page);

// Fetch user's orders with pagination
$stmt = $conn->prepare("
    SELECT o.*, u.name as customer_name 
    FROM orders o 
    JOIN users u ON o.user_id = u.id 
    WHERE o.user_id = ? 
    ORDER BY o.ordered_at DESC 
    LIMIT ? OFFSET ?
");
$stmt->bind_param("iii", $user_id, $per_page, $offset);
$stmt->execute();
$orders_result = $stmt->get_result();

$orders = [];
while ($row = $orders_result->fetch_assoc()) {
    $orders[] = $row;
}
$stmt->close();

// Function to get order items
function getOrderItems($conn, $order_id) {
    $stmt = $conn->prepare("
        SELECT oi.*, mi.name as item_name, mi.image as item_image, mi.id as menu_item_id
        FROM order_items oi 
        JOIN menu_items mi ON oi.item_id = mi.id 
        WHERE oi.order_id = ?
    ");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    $stmt->close();
    
    return $items;
}

// Function to get status color
function getStatusColor($status) {
    switch (strtolower($status)) {
        case 'pending': return '#ffc107';
        case 'processing': return '#17a2b8';
        case 'completed': return '#28a745';
        case 'cancelled': return '#dc3545';
        default: return '#6c757d';
    }
}

// Function to get status icon
function getStatusIcon($status) {
    switch (strtolower($status)) {
        case 'pending': return 'bi-clock';
        case 'processing': return 'bi-gear';
        case 'completed': return 'bi-check-circle';
        case 'cancelled': return 'bi-x-circle';
        default: return 'bi-question-circle';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Food Delivery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            background-color: #f7ece3ff;
        }

        .orders-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            margin: 2rem 0;
        }

        .orders-header {
            background: linear-gradient(135deg, #BA8C63, #a67c56);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .order-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 25px rgba(0,0,0,0.15);
        }

        .order-header {
            background: #f8f9fa;
            padding: 1.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        .order-body {
            padding: 1.5rem;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: bold;
            font-size: 0.875rem;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #f8f9fa;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 1rem;
        }

        .order-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-reorder {
            background-color: #BA8C63;
            border-color: #BA8C63;
            color: white;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .btn-reorder:hover {
            background-color: #a67c56;
            border-color: #a67c56;
            transform: translateY(-1px);
        }

        .btn-cancel {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .btn-track {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: white;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .empty-orders {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
        }

        .empty-orders i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #BA8C63;
        }

        .pagination-custom .page-link {
            color: #BA8C63;
            border-color: #BA8C63;
        }

        .pagination-custom .page-item.active .page-link {
            background-color: #BA8C63;
            border-color: #BA8C63;
        }

        .order-summary {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .filter-tabs {
            background: white;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .filter-btn {
            background: transparent;
            border: 2px solid #BA8C63;
            color: #BA8C63;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .filter-btn.active, .filter-btn:hover {
            background-color: #BA8C63;
            color: white;
        }

        .order-timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 1rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -2rem;
            top: 0.5rem;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #BA8C63;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            left: -1.75rem;
            top: 1.2rem;
            width: 2px;
            height: calc(100% - 0.5rem);
            background-color: #e9ecef;
        }

        .timeline-item:last-child::after {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Header Image -->
    <div style="z-index: 50; transform: translateY(0%); width: 100%;">
        <img src="includes/images/bg-2.jpg" class="img-fluid mainimg" alt="My Orders Background">
    </div>

    <div class="container my-5">
        <!-- Page Header -->
        <div class="orders-container">
            <div class="orders-header">
                <h1 class="mb-3"><i class="bi bi-bag-check"></i> My Orders</h1>
                <p class="lead mb-0">Track your delicious orders and reorder your favorites</p>
            </div>

            <!-- Notifications -->
            <div class="p-3">
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
            </div>

            <!-- Filter Tabs -->
            <div class="filter-tabs">
                <h6 class="mb-3">Filter Orders:</h6>
                <button class="filter-btn active" onclick="filterOrders('all')">All Orders</button>
                <button class="filter-btn" onclick="filterOrders('pending')">Pending</button>
                <button class="filter-btn" onclick="filterOrders('processing')">Processing</button>
                <button class="filter-btn" onclick="filterOrders('completed')">Completed</button>
                <button class="filter-btn" onclick="filterOrders('cancelled')">Cancelled</button>
            </div>
        </div>

        <!-- Orders List -->
        <?php if (empty($orders)): ?>
            <div class="orders-container">
                <div class="empty-orders">
                    <i class="bi bi-bag-x"></i>
                    <h3>No Orders Yet</h3>
                    <p>You haven't placed any orders yet. Start exploring our delicious menu!</p>
                    <a href="menu.php" class="btn btn-reorder">
                        <i class="bi bi-plus-circle"></i> Order Now
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div id="ordersContainer">
                <?php foreach ($orders as $order): ?>
                    <?php 
                    $order_items = getOrderItems($conn, $order['id']);
                    $status_color = getStatusColor($order['status']);
                    $status_icon = getStatusIcon($order['status']);
                    ?>
                    
                    <div class="order-card" data-status="<?= strtolower($order['status']) ?>">
                        <!-- Order Header -->
                        <div class="order-header">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <h5 class="mb-1">Order #<?= $order['id'] ?></h5>
                                    <small class="text-muted"><?= date('M d, Y - h:i A', strtotime($order['ordered_at'])) ?></small>
                                </div>
                                <div class="col-md-3">
                                    <span class="status-badge" style="background-color: <?= $status_color ?>; color: white;">
                                        <i class="<?= $status_icon ?>"></i> <?= ucfirst($order['status']) ?>
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <h5 class="mb-0" style="color: #BA8C63;">₹<?= number_format($order['total'], 2) ?></h5>
                                    <small class="text-muted"><?= count($order_items) ?> item(s)</small>
                                </div>
                                <div class="col-md-3">
                                    <div class="order-actions">
                                        <?php if ($order['status'] === 'Pending'): ?>
                                            <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to cancel this order?')">
                                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                                <button type="submit" name="cancel_order" class="btn btn-cancel btn-sm">
                                                    <i class="bi bi-x-circle"></i> Cancel
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        
                                        <button class="btn btn-track btn-sm" onclick="toggleOrderDetails(<?= $order['id'] ?>)">
                                            <i class="bi bi-eye"></i> Details
                                        </button>
                                        
                                        <button class="btn btn-reorder btn-sm" onclick="reorderItems(<?= $order['id'] ?>)">
                                            <i class="bi bi-arrow-repeat"></i> Reorder
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Body (Initially Hidden) -->
                        <div class="order-body collapse" id="orderDetails<?= $order['id'] ?>">
                            <div class="row">
                                <!-- Order Items -->
                                <div class="col-md-8">
                                    <h6 class="mb-3" style="color: #BA8C63;"><i class="bi bi-bag"></i> Order Items</h6>
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
                                                <small class="text-muted">Qty: <?= $item['quantity'] ?> × ₹<?= number_format($item['price'], 2) ?></small>
                                            </div>
                                            <div class="text-end">
                                                <strong style="color: #BA8C63;">₹<?= number_format($item['price'] * $item['quantity'], 2) ?></strong>
                                                <br>
                                                <button class="btn btn-sm btn-outline-primary" onclick="addToCart(<?= $item['menu_item_id'] ?>, '<?= htmlspecialchars($item['item_name']) ?>', <?= $item['price'] ?>)">
                                                    <i class="bi bi-cart-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Order Timeline -->
                                <div class="col-md-4">
                                    <h6 class="mb-3" style="color: #BA8C63;"><i class="bi bi-clock-history"></i> Order Timeline</h6>
                                    <div class="order-timeline">
                                        <div class="timeline-item">
                                            <strong>Order Placed</strong>
                                            <br><small class="text-muted"><?= date('M d, Y - h:i A', strtotime($order['ordered_at'])) ?></small>
                                        </div>
                                        
                                        <?php if ($order['status'] !== 'Pending'): ?>
                                            <div class="timeline-item">
                                                <strong>Order Confirmed</strong>
                                                <br><small class="text-muted">Processing started</small>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if ($order['status'] === 'Completed'): ?>
                                            <div class="timeline-item">
                                                <strong>Order Delivered</strong>
                                                <br><small class="text-muted">Enjoy your meal!</small>
                                            </div>
                                        <?php elseif ($order['status'] === 'Cancelled'): ?>
                                            <div class="timeline-item">
                                                <strong>Order Cancelled</strong>
                                                <br><small class="text-muted">Order was cancelled</small>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Order Summary -->
                                    <div class="order-summary mt-3">
                                        <h6 style="color: #BA8C63;">Order Summary</h6>
                                        <div class="d-flex justify-content-between">
                                            <span>Total Amount:</span>
                                            <strong>₹<?= number_format($order['total'], 2) ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
                <div class="d-flex justify-content-center mt-4">
                    <nav>
                        <ul class="pagination pagination-custom">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                                </li>
                            <?php endif; ?>
                            
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            
                            <?php if ($page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Quick Actions -->
        <div class="text-center mt-4">
            <a href="menu.php" class="btn btn-reorder me-3">
                <i class="bi bi-plus-circle"></i> Order Again
            </a>
            <a href="cart.php" class="btn btn-outline-secondary">
                <i class="bi bi-cart"></i> View Cart
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle order details
        function toggleOrderDetails(orderId) {
            const detailsElement = document.getElementById('orderDetails' + orderId);
            const bsCollapse = new bootstrap.Collapse(detailsElement);
            bsCollapse.toggle();
        }

        // Filter orders by status
        function filterOrders(status) {
            const orders = document.querySelectorAll('.order-card');
            const filterBtns = document.querySelectorAll('.filter-btn');
            
            // Update active filter button
            filterBtns.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Show/hide orders based on status
            orders.forEach(order => {
                if (status === 'all' || order.dataset.status === status) {
                    order.style.display = 'block';
                } else {
                    order.style.display = 'none';
                }
            });
        }

        // Add item to cart
        function addToCart(itemId, itemName, itemPrice) {
            fetch('add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=add&item_id=${itemId}&quantity=1`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`${itemName} added to cart!`);
                } else {
                    alert('Failed to add item to cart: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while adding item to cart');
            });
        }

        // Reorder all items from an order
        function reorderItems(orderId) {
            if (confirm('Add all items from this order to your cart?')) {
                // Get all items from this order
                const orderCard = document.querySelector(`[data-status] .order-body#orderDetails${orderId}`);
                if (!orderCard) {
                    // If details are not visible, we need to get items via AJAX or show details first
                    alert('Please view order details first, then try reordering.');
                    return;
                }
                
                const addButtons = orderCard.querySelectorAll('button[onclick*="addToCart"]');
                let itemsAdded = 0;
                
                addButtons.forEach(button => {
                    const onclickAttr = button.getAttribute('onclick');
                    const matches = onclickAttr.match(/addToCart\((\d+), '(.+)', ([\d.]+)\)/);
                    
                    if (matches) {
                        const [, itemId, itemName, itemPrice] = matches;
                        
                        fetch('add_to_cart.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `action=add&item_id=${itemId}&quantity=1`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                itemsAdded++;
                            }
                        });
                    }
                });
                
                setTimeout(() => {
                    alert(`${itemsAdded} items added to cart!`);
                    if (confirm('Go to cart now?')) {
                        window.location.href = 'cart.php';
                    }
                }, 1000);
            }
        }

        // Auto-refresh order status every 30 seconds for pending/processing orders
        function refreshOrderStatus() {
            const pendingOrders = document.querySelectorAll('[data-status="pending"], [data-status="processing"]');
            if (pendingOrders.length > 0) {
                // In a real application, you would make an AJAX call to check for status updates
                console.log('Checking for order status updates...');
            }
        }

        // Set up auto-refresh
        setInterval(refreshOrderStatus, 30000);
    </script>

    <?php require('footer.php') ?>
</body>
</html>