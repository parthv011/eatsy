<?php require('header.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .body{
             background-color: #f7ece3ff;
        }
        .order-card {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .order-card:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .order-header {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 12px 12px 0 0;
            padding: 20px;
            border-bottom: 1px solid #dee2e6;
        }
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-preparing {
            background: #fff3cd;
            color: #856404;
        }
        .status-delivered {
            background: #d1edff;
            color: #0c63e4;
        }
        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }
        .status-on-way {
            background: #d4edda;
            color: #155724;
        }
        .order-item {
            padding: 15px 20px;
            border-bottom: 1px solid #f1f3f4;
        }
        .order-item:last-child {
            border-bottom: none;
        }
        .item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
        .order-actions {
            padding: 15px 20px;
            background: #f8f9fa;
            border-radius: 0 0 12px 12px;
        }
        .track-btn {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        .track-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
            color: white;
        }
        .reorder-btn {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        .reorder-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
            color: white;
        }
        .filter-tabs {
            border-bottom: 2px solid #f1f3f4;
            margin-bottom: 30px;
        }
        .filter-tab {
            padding: 12px 24px;
            border: none;
            background: none;
            color: #6c757d;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        .filter-tab.active {
            color: #007bff;
            border-bottom-color: #007bff;
        }
        .filter-tab:hover {
            color: #007bff;
        }
        .empty-orders {
            text-align: center;
            padding: 80px 20px;
            color: #6c757d;
        }
        .rating-stars {
            color: #ffc107;
        }
        .order-timeline {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 15px;
        }
        .timeline-step {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
        }
        .timeline-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #dee2e6;
        }
        .timeline-dot.active {
            background: #28a745;
        }
        .timeline-dot.current {
            background: #ffc107;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4"><i class="fas fa-receipt me-2"></i>My Orders</h2>
                
                <!-- Filter Tabs -->
                <div class="filter-tabs mb-4">
                    <button class="filter-tab active" onclick="filterOrders('all')">All Orders</button>
                    <button class="filter-tab" onclick="filterOrders('active')">Active</button>
                    <button class="filter-tab" onclick="filterOrders('delivered')">Delivered</button>
                    <button class="filter-tab" onclick="filterOrders('cancelled')">Cancelled</button>
                </div>

                <div id="orders-container">
                    <!-- Order 1 - On the Way -->
                    <div class="order-card" data-status="active">
                        <div class="order-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="mb-1">Order #12345</h5>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-calendar me-1"></i>January 15, 2025 at 2:30 PM
                                    </p>
                                </div>
                                <div class="col-md-3 text-md-center">
                                    <span class="status-badge status-on-way">On the Way</span>
                                </div>
                                <div class="col-md-3 text-md-end">
                                    <h5 class="mb-0">$48.78</h5>
                                    <small class="text-muted">3 items</small>
                                </div>
                            </div>
                            
                            <!-- Order Timeline -->
                            <div class="order-timeline">
                                <div class="timeline-step">
                                    <div class="timeline-dot active"></div>
                                    <span>Confirmed</span>
                                </div>
                                <div class="timeline-step">
                                    <div class="timeline-dot active"></div>
                                    <span>Preparing</span>
                                </div>
                                <div class="timeline-step">
                                    <div class="timeline-dot current"></div>
                                    <span>On the Way</span>
                                </div>
                                <div class="timeline-step">
                                    <div class="timeline-dot"></div>
                                    <span>Delivered</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-item">
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=150&h=150&fit=crop" alt="Margherita Pizza" class="item-image">
                                </div>
                                <div class="col-6">
                                    <h6 class="mb-1">Margherita Pizza</h6>
                                    <p class="text-muted mb-0 small">Large size</p>
                                </div>
                                <div class="col-2 text-center">
                                    <span class="fw-bold">x2</span>
                                </div>
                                <div class="col-2 text-end">
                                    <span class="fw-bold">$24.98</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-item">
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=150&h=150&fit=crop" alt="Caesar Salad" class="item-image">
                                </div>
                                <div class="col-6">
                                    <h6 class="mb-1">Caesar Salad</h6>
                                    <p class="text-muted mb-0 small">Regular size</p>
                                </div>
                                <div class="col-2 text-center">
                                    <span class="fw-bold">x1</span>
                                </div>
                                <div class="col-2 text-end">
                                    <span class="fw-bold">$7.50</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-actions">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-0 small text-muted">
                                        <i class="fas fa-map-marker-alt me-1"></i>Delivering to: 123 Main St, City
                                    </p>
                                    <p class="mb-0 small text-success">
                                        <i class="fas fa-clock me-1"></i>ETA: 15-20 minutes
                                    </p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <button class="btn track-btn me-2">
                                        <i class="fas fa-map-marker-alt me-1"></i>Track Order
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-phone me-1"></i>Call Restaurant
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order 2 - Delivered -->
                    <div class="order-card" data-status="delivered">
                        <div class="order-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="mb-1">Order #12344</h5>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-calendar me-1"></i>January 14, 2025 at 7:45 PM
                                    </p>
                                </div>
                                <div class="col-md-3 text-md-center">
                                    <span class="status-badge status-delivered">Delivered</span>
                                </div>
                                <div class="col-md-3 text-md-end">
                                    <h5 class="mb-0">$32.50</h5>
                                    <small class="text-muted">2 items</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-item">
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=150&h=150&fit=crop" alt="Chicken Burger" class="item-image">
                                </div>
                                <div class="col-6">
                                    <h6 class="mb-1">Chicken Burger</h6>
                                    <p class="text-muted mb-0 small">Medium size</p>
                                </div>
                                <div class="col-2 text-center">
                                    <span class="fw-bold">x2</span>
                                </div>
                                <div class="col-2 text-end">
                                    <span class="fw-bold">$17.98</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-item">
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <img src="https://images.unsplash.com/photo-1625944230945-1b7dd3b949ab?w=150&h=150&fit=crop" alt="French Fries" class="item-image">
                                </div>
                                <div class="col-6">
                                    <h6 class="mb-1">French Fries</h6>
                                    <p class="text-muted mb-0 small">Large size</p>
                                </div>
                                <div class="col-2 text-center">
                                    <span class="fw-bold">x1</span>
                                </div>
                                <div class="col-2 text-end">
                                    <span class="fw-bold">$6.99</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-actions">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <p class="mb-0 small text-muted">
                                        <i class="fas fa-check-circle me-1 text-success"></i>Delivered on Jan 14, 2025 at 8:15 PM
                                    </p>
                                    <div class="rating-stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="ms-2 text-muted">Rated 5.0</span>
                                    </div>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <button class="btn reorder-btn me-2">
                                        <i class="fas fa-redo me-1"></i>Reorder
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-receipt me-1"></i>Receipt
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order 3 - Preparing -->
                    <div class="order-card" data-status="active">
                        <div class="order-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="mb-1">Order #12343</h5>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-calendar me-1"></i>January 13, 2025 at 1:15 PM
                                    </p>
                                </div>
                                <div class="col-md-3 text-md-center">
                                    <span class="status-badge status-preparing">Preparing</span>
                                </div>
                                <div class="col-md-3 text-md-end">
                                    <h5 class="mb-0">$19.99</h5>
                                    <small class="text-muted">1 item</small>
                                </div>
                            </div>
                            
                            <!-- Order Timeline -->
                            <div class="order-timeline">
                                <div class="timeline-step">
                                    <div class="timeline-dot active"></div>
                                    <span>Confirmed</span>
                                </div>
                                <div class="timeline-step">
                                    <div class="timeline-dot current"></div>
                                    <span>Preparing</span>
                                </div>
                                <div class="timeline-step">
                                    <div class="timeline-dot"></div>
                                    <span>On the Way</span>
                                </div>
                                <div class="timeline-step">
                                    <div class="timeline-dot"></div>
                                    <span>Delivered</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-item">
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=150&h=150&fit=crop" alt="Pasta Carbonara" class="item-image">
                                </div>
                                <div class="col-6">
                                    <h6 class="mb-1">Pasta Carbonara</h6>
                                    <p class="text-muted mb-0 small">Regular size</p>
                                </div>
                                <div class="col-2 text-center">
                                    <span class="fw-bold">x1</span>
                                </div>
                                <div class="col-2 text-end">
                                    <span class="fw-bold">$15.99</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-actions">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-0 small text-muted">
                                        <i class="fas fa-clock me-1"></i>Estimated preparation time: 25-30 minutes
                                    </p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <button class="btn btn-outline-danger btn-sm me-2">
                                        <i class="fas fa-times me-1"></i>Cancel Order
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-phone me-1"></i>Call Restaurant
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div id="empty-orders" class="empty-orders d-none">
                    <i class="fas fa-receipt fa-4x mb-3"></i>
                    <h4>No orders found</h4>
                    <p>You haven't placed any orders yet. Start exploring our delicious menu!</p>
                    <a href="menu.php" class="btn btn-primary">Browse Menu</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterOrders(status) {
            const orders = document.querySelectorAll('.order-card');
            const tabs = document.querySelectorAll('.filter-tab');
            const emptyState = document.getElementById('empty-orders');
            
            // Update active tab
            tabs.forEach(tab => tab.classList.remove('active'));
            event.target.classList.add('active');
            
            let visibleOrders = 0;
            
            orders.forEach(order => {
                const orderStatus = order.getAttribute('data-status');
                
                if (status === 'all' || 
                    (status === 'active' && orderStatus === 'active') ||
                    (status === 'delivered' && orderStatus === 'delivered') ||
                    (status === 'cancelled' && orderStatus === 'cancelled')) {
                    order.style.display = 'block';
                    visibleOrders++;
                } else {
                    order.style.display = 'none';
                }
            });
            
            // Show empty state if no orders match filter
            if (visibleOrders === 0) {
                emptyState.classList.remove('d-none');
            } else {
                emptyState.classList.add('d-none');
            }
        }
        
        // Add click handlers for action buttons
        document.addEventListener('DOMContentLoaded', function() {
            // Track order buttons
            document.querySelectorAll('.track-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    alert('Opening order tracking...');
                });
            });
            
            // Reorder buttons
            document.querySelectorAll('.reorder-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    alert('Adding items to cart...');
                });
            });
            
            // Call restaurant buttons
            document.querySelectorAll('.btn-outline-secondary').forEach(btn => {
                if (btn.textContent.includes('Call Restaurant')) {
                    btn.addEventListener('click', function() {
                        alert('Calling restaurant...');
                    });
                }
            });
            
            // Cancel order buttons
            document.querySelectorAll('.btn-outline-danger').forEach(btn => {
                if (btn.textContent.includes('Cancel Order')) {
                    btn.addEventListener('click', function() {
                        if (confirm('Are you sure you want to cancel this order?')) {
                            alert('Order cancelled successfully');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>