<?php
session_start();
require('header.php'); // Your DB connection included here

// Update order status if POSTed
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $order_id = (int)$_POST['order_id'];
    $status = $_POST['status'];

    $allowed_statuses = ['Pending', 'Processing', 'Completed', 'Cancelled'];
    if (in_array($status, $allowed_statuses)) {
        $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->bind_param('si', $status, $order_id);
        $stmt->execute();
        $_SESSION['message'] = $stmt->affected_rows ? "Order #$order_id status updated to $status." : "No changes made.";
        $stmt->close();
    } else {
        $_SESSION['error'] = "Invalid order status.";
    }
    header("Location: manage_orders.php");
    exit;
}

$sql = "
    SELECT o.id, o.total, o.status, o.ordered_at,
           u.name AS customer_name, u.email AS customer_email, u.phone AS customer_phone
    FROM orders o
    JOIN users u ON o.user_id = u.id
    ORDER BY o.ordered_at DESC
";

$result = $conn->query($sql);

function getOrderItems($conn, $order_id) {
    $stmt = $conn->prepare("
        SELECT mi.name, oi.quantity 
        FROM order_items oi 
        JOIN menu_items mi ON oi.menu_item_id = mi.id 
        WHERE oi.order_id = ?
    ");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $items = [];
    while ($row = $res->fetch_assoc()) {
        $items[] = $row;
    }
    $stmt->close();
    return $items;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Manage Orders</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">Manage Orders</h1>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Items</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Update Status</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($order = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($order['id']); ?></td>
                <td>
                    <?= htmlspecialchars($order['customer_name']); ?><br>
                    <?= htmlspecialchars($order['customer_email']); ?><br>
                    <?= htmlspecialchars($order['customer_phone']); ?>
                </td>
                <td>
                    <?php
                    $items = getOrderItems($conn, $order['id']);
                    if (!empty($items)) {
                        foreach ($items as $item) {
                            echo htmlspecialchars($item['name'] . " x" . $item['quantity']) . "<br>";
                        }
                    } else {
                        echo "No items";
                    }
                    ?>
                </td>
                <td>₹ <?= number_format($order['total'], 2); ?></td>
                <td><?= htmlspecialchars($order['status']); ?></td>
                <td><?= htmlspecialchars($order['ordered_at']); ?></td>
                <td>
                    <form method="POST" class="d-flex gap-2">
                        <input type="hidden" name="order_id" value="<?= $order['id']; ?>" />
                        <select name="status" class="form-select form-select-sm" required>
                            <?php
                            $statuses = ['Pending', 'Processing', 'Completed', 'Cancelled'];
                            foreach ($statuses as $status) {
                                $selected = $order['status'] === $status ? 'selected' : '';
                                echo "<option value=\"$status\" $selected>$status</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
