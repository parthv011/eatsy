<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EATSY</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #ff6b35 !important;
        }
        
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .nav-link {
            color: #333 !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: #ff6b35 !important;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .dropdown-item:hover {
            background-color: #ff6b35;
            color: white;
        }
        
        .badge-notification {
            background-color: #dc3545;
            font-size: 0.75rem;
        }
        
        .admin-content {
            padding: 2rem 0;
            background-color: #f8f9fa;
            min-height: calc(100vh - 76px);
        }
        
        .welcome-card {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: white;
            border-radius: 10px;
        }

        .stat-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .recent-orders {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Admin Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand" href="#">
                <i class="fas fa-utensils me-2"></i>
                EATSY Admin
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Items -->
            <div class="collapse navbar-collapse" id="adminNavbar">
                <!-- Left Side Navigation -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#dashboard">
                            <i class="fas fa-tachometer-alt me-1"></i>
                            Dashboard
                        </a>
                    </li>
                    
                    <!-- Orders Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-shopping-cart me-1"></i>
                            Orders
                            <span class="badge badge-notification ms-1">12</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#new-orders">
                                <i class="fas fa-clock me-2"></i>New Orders
                            </a></li>
                            <li><a class="dropdown-item" href="#processing">
                                <i class="fas fa-spinner me-2"></i>Processing
                            </a></li>
                            <li><a class="dropdown-item" href="#completed">
                                <i class="fas fa-check-circle me-2"></i>Completed
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#all-orders">
                                <i class="fas fa-list me-2"></i>All Orders
                            </a></li>
                        </ul>
                    </li>

                    <!-- Menu Management Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-hamburger me-1"></i>
                            Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#menu-items">
                                <i class="fas fa-utensils me-2"></i>Menu Items
                            </a></li>
                            <li><a class="dropdown-item" href="#categories">
                                <i class="fas fa-tags me-2"></i>Categories
                            </a></li>
                            <li><a class="dropdown-item" href="#add-item">
                                <i class="fas fa-plus me-2"></i>Add New Item
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#inventory">
                                <i class="fas fa-boxes me-2"></i>Inventory
                            </a></li>
                        </ul>
                    </li>

                    <!-- Customers -->
                    <li class="nav-item">
                        <a class="nav-link" href="#customers">
                            <i class="fas fa-users me-1"></i>
                            Customers
                        </a>
                    </li>

                    <!-- Reports Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-chart-line me-1"></i>
                            Reports
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#sales-report">
                                <i class="fas fa-dollar-sign me-2"></i>Sales Report
                            </a></li>
                            <li><a class="dropdown-item" href="#order-analytics">
                                <i class="fas fa-chart-bar me-2"></i>Order Analytics
                            </a></li>
                            <li><a class="dropdown-item" href="#customer-insights">
                                <i class="fas fa-user-chart me-2"></i>Customer Insights
                            </a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Right Side Navigation -->
                <ul class="navbar-nav">
                    <!-- Notifications -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            <span class="badge badge-notification">5</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="width: 300px;">
                            <li><h6 class="dropdown-header">Recent Notifications</h6></li>
                            <li><a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <i class="fas fa-shopping-cart text-primary me-2 mt-1"></i>
                                    <div>
                                        <strong>New Order #1234</strong>
                                        <br><small class="text-muted">2 minutes ago</small>
                                    </div>
                                </div>
                            </a></li>
                            <li><a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <i class="fas fa-user-plus text-success me-2 mt-1"></i>
                                    <div>
                                        <strong>New Customer Registration</strong>
                                        <br><small class="text-muted">5 minutes ago</small>
                                    </div>
                                </div>
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center" href="#all-notifications">
                                View All Notifications
                            </a></li>
                        </ul>
                    </li>

                    <!-- Admin Profile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <img src="https://via.placeholder.com/32x32/007bff/ffffff?text=A" class="rounded-circle me-2" alt="Admin" width="32" height="32">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#profile">
                                <i class="fas fa-user me-2"></i>My Profile
                            </a></li>
                            <li><a class="dropdown-item" href="#settings">
                                <i class="fas fa-cog me-2"></i>Settings
                            </a></li>
                            <li><a class="dropdown-item" href="#restaurant-settings">
                                <i class="fas fa-store me-2"></i>Restaurant Settings
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="admin-content">
        <div class="container-fluid">
            <!-- Welcome Section -->
            <div class="row">
                <div class="col-12">
                    <div class="welcome-card card border-0 mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="card-title mb-2">Welcome back, Admin!</h2>
                                    <p class="card-text mb-0">Here's what's happening with your restaurant today.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Stats Cards -->
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-primary bg-opacity-10 text-primary me-3">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-uppercase text-muted mb-1">Today's Orders</h6>
                                    <h4 class="mb-0">45</h4>
                                    <small class="text-success">
                                        <i class="fas fa-arrow-up me-1"></i>12% from yesterday
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-success bg-opacity-10 text-success me-3">
                                    <i class="fas fa-rupee-sign"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-uppercase text-muted mb-1">Today's Revenue</h6>
                                    <h4 class="mb-0">₹12,450</h4>
                                    <small class="text-success">
                                        <i class="fas fa-arrow-up me-1"></i>8% from yesterday
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-warning bg-opacity-10 text-warning me-3">
                                    <i class="fas fa-hamburger"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-uppercase text-muted mb-1">Menu Items</h6>
                                    <h4 class="mb-0">127</h4>
                                    <small class="text-muted">
                                        <i class="fas fa-plus me-1"></i>3 added this week
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-info bg-opacity-10 text-info me-3">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="text-uppercase text-muted mb-1">Total Customers</h6>
                                    <h4 class="mb-0">1,234</h4>
                                    <small class="text-success">
                                        <i class="fas fa-arrow-up me-1"></i>15 new this week
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Section -->
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="recent-orders p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Recent Orders</h5>
                            <a href="#all-orders" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Items</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>#ORD20250126001</strong></td>
                                        <td>John Doe</td>
                                        <td>Margherita Pizza, Cold Drink</td>
                                        <td>₹420</td>
                                        <td><span class="badge bg-warning">Preparing</span></td>
                                        <td>2 min ago</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>#ORD20250126002</strong></td>
                                        <td>Jane Smith</td>
                                        <td>Paneer Burger, Fries</td>
                                        <td>₹350</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                        <td>15 min ago</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>#ORD20250126003</strong></td>
                                        <td>Mike Johnson</td>
                                        <td>Paneer Tacos, Shake</td>
                                        <td>₹480</td>
                                        <td><span class="badge bg-primary">New</span></td>
                                        <td>5 min ago</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add New Menu Item
                                </button>
                                <button class="btn btn-success">
                                    <i class="fas fa-eye me-2"></i>View All Orders
                                </button>
                                <button class="btn btn-info">
                                    <i class="fas fa-users me-2"></i>Manage Customers
                                </button>
                                <button class="btn btn-warning">
                                    <i class="fas fa-chart-bar me-2"></i>View Reports
                                </button>
                                <button class="btn btn-secondary">
                                    <i class="fas fa-cog me-2"></i>Restaurant Settings
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Recent Activity</h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="bg-success rounded-circle p-2">
                                            <i class="fas fa-check text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Order #1234 completed</h6>
                                        <small class="text-muted">2 minutes ago</small>
                                    </div>
                                </div>
                                
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary rounded-circle p-2">
                                            <i class="fas fa-plus text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">New customer registered</h6>
                                        <small class="text-muted">5 minutes ago</small>
                                    </div>
                                </div>
                                
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-warning rounded-circle p-2">
                                            <i class="fas fa-utensils text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Menu item updated</h6>
                                        <small class="text-muted">10 minutes ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Add active state management
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Remove active class from all nav links (excluding dropdowns)
                    if (!this.classList.contains('dropdown-toggle')) {
                        navLinks.forEach(nl => {
                            if (!nl.classList.contains('dropdown-toggle')) {
                                nl.classList.remove('active');
                            }
                        });
                        // Add active class to clicked link
                        this.classList.add('active');
                    }
                });
            });
            
            // Simulate real-time updates
            let orderCount = 45;
            let revenue = 12450;
            
            setInterval(() => {
                // Randomly update stats
                if (Math.random() > 0.9) {
                    orderCount++;
                    revenue += Math.floor(Math.random() * 500) + 100;
                    
                    document.querySelector('.stat-card:first-child h4').textContent = orderCount;
                    document.querySelector('.stat-card:nth-child(2) h4').textContent = '₹' + revenue.toLocaleString();
                }
            }, 5000);
            
            // Update time display
            setInterval(() => {
                const now = new Date();
                const timeStr = now.toLocaleString('en-IN', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                // Update last login time display if needed
                document.querySelector('.opacity-75 small').innerHTML = 
                    '<i class="fas fa-clock me-1"></i>Current time: ' + timeStr;
            }, 60000); // Update every minute
        });

        // Add confirmation for logout
        document.querySelector('a[href="logout.php"]').addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to logout?')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>