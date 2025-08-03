<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

// Connect to the database
require_once '../includes/db.php';

// Fetch counts
$userCount = $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0];
$menuCount = $conn->query("SELECT COUNT(*) FROM menu_items")->fetch_row()[0];
$categoryCount = $conn->query("SELECT COUNT(*) FROM categories")->fetch_row()[0];
$orderCount = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'Pending'")->fetch_row()[0];
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="container mt-4">
    <h3>Welcome, Admin</h3>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <h3><?php echo $userCount; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Menu Items</h5>
                    <h3><?php echo $menuCount; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5>Categories</h5>
                    <h3><?php echo $categoryCount; ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>New Orders</h5>
                    <h3><?php echo $orderCount; ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
<script>
    setInterval(() => {
  fetch('check_new_orders.php')
    .then(res => res.json())
    .then(data => {
      if (data.new_orders_count > 0) {
        alert(`You have ${data.new_orders_count} new order(s)!`);
        // Or update a badge or show a nicer popup in HTML
      }
    });
}, 30000); // every 30 seconds

</script>