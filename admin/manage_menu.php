<?php
session_start();
require('../includes/header.php');
require_once '../includes/db.php';

// Handle form submissions

function uploadImage($file) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    $max_size = 2 * 1024 * 1024; // 2 MB max

    if ($file['error'] === UPLOAD_ERR_NO_FILE) {
        // No file uploaded
        return null;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Upload error: " . $file['error']);
    }

    if (!in_array($file['type'], $allowed_types)) {
        throw new Exception("Invalid file type. Only JPG, PNG, GIF allowed.");
    }

    if ($file['size'] > $max_size) {
        throw new Exception("File size exceeds 2MB limit.");
    }

    // Create uploads directory if it doesn't exist
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Generate unique filename
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid('img_', true) . '.' . $ext;
    $destination = $upload_dir . $filename;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new Exception("Failed to move uploaded file.");
    }

    return $destination;
}

// ADD ITEM
if (isset($_POST['add_item'])) {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;
    $category_id = $_POST['category_id'] ?? 0;

    try {
        $image_path = uploadImage($_FILES['image']);
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: manage_menu.php");
        exit;
    }

    if ($name && $price > 0 && $category_id > 0 && $image_path) {
        $stmt = $conn->prepare("INSERT INTO menu_items (name, description, price, image, category_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsi", $name, $description, $price, $image_path, $category_id);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Menu item added successfully.";
        } else {
            $_SESSION['error'] = "Failed to add item.";
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Please fill in all required fields including image.";
    }
    header("Location: manage_menu.php");
    exit;
}

// EDIT ITEM
if (isset($_POST['edit_item'])) {
    $id = $_POST['id'] ?? 0;
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;
    $category_id = $_POST['category_id'] ?? 0;

    $image_path = null;
    try {
        $image_path = uploadImage($_FILES['image']);
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: manage_menu.php?edit_id=" . $id);
        exit;
    }

    // If no new image uploaded, keep old image
    if (!$image_path) {
        $stmt = $conn->prepare("SELECT image FROM menu_items WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($old_image);
        $stmt->fetch();
        $stmt->close();
        $image_path = $old_image;
    } else {
        // Optionally delete old image file here if you want
    }

    if ($id > 0 && $name && $price > 0 && $category_id > 0) {
        $stmt = $conn->prepare("UPDATE menu_items SET name=?, description=?, price=?, image=?, category_id=? WHERE id=?");
        $stmt->bind_param("ssdssi", $name, $description, $price, $image_path, $category_id, $id);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Menu item updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update item.";
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Please fill in all required fields.";
    }
    header("Location: manage_menu.php");
    exit;
}


// Delete item
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM menu_items WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Menu item deleted.";
    } else {
        $_SESSION['error'] = "Failed to delete item.";
    }
    $stmt->close();
    header("Location: manage_menu.php");
    exit;
}

// Fetch categories for dropdown
$categories = [];
$res = $conn->query("SELECT id, name FROM categories ORDER BY name");
while ($row = $res->fetch_assoc()) {
    $categories[] = $row;
}

// Fetch items for listing
$items = [];
$res = $conn->query("SELECT menu_items.*, categories.name AS category_name FROM menu_items JOIN categories ON menu_items.category_id = categories.id ORDER BY menu_items.created_at DESC");
while ($row = $res->fetch_assoc()) {
    $items[] = $row;
}

// If editing, fetch item data
$edit_item = null;
if (isset($_GET['edit_id'])) {
    $edit_id = (int)$_GET['edit_id'];
    $stmt = $conn->prepare("SELECT * FROM menu_items WHERE id = ?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $edit_item = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Manage Menu Items - Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container my-5">
    <h1 class="mb-4">Manage Menu Items</h1>

    <!-- Notifications -->
    <?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?php echo htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <!-- Add/Edit Form -->
    <div class="card mb-5">
        <div class="card-header">
            <?php echo $edit_item ? "Edit Item" : "Add New Item"; ?>
        </div>
        <div class="card-body">
            <form method="post" action="manage_menu.php" enctype="multipart/form-data">
                <?php if ($edit_item): ?>
                    <input type="hidden" name="id" value="<?php echo $edit_item['id']; ?>" />
                <?php endif; ?>

                <div class="mb-3">
                    <label for="name" class="form-label">Item Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" required value="<?php echo htmlspecialchars($edit_item['name'] ?? ''); ?>" />
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="3"><?php echo htmlspecialchars($edit_item['description'] ?? ''); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (₹) <span class="text-danger">*</span></label>
                    <input type="number" id="price" name="price" step="0.01" min="0" class="form-control" required value="<?php echo htmlspecialchars($edit_item['price'] ?? ''); ?>" />
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                    <select id="category_id" name="category_id" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>" <?php if (($edit_item['category_id'] ?? '') == $cat['id']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($cat['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
    <label for="image" class="form-label">Image <?php if (!$edit_item) echo '<span class="text-danger">*</span>'; ?></label><br/>
    <?php if ($edit_item && $edit_item['image'] && file_exists($edit_item['image'])): ?>
        <img src="<?php echo htmlspecialchars($edit_item['image']); ?>" alt="Current Image" style="max-width: 150px; margin-bottom: 10px; border-radius:5px;">
        <br>
    <?php endif; ?>
    <input type="file" id="image" name="image" class="form-control" <?php if (!$edit_item) echo 'required'; ?> accept="image/*" />
</div>


                <button type="submit" name="<?php echo $edit_item ? 'edit_item' : 'add_item'; ?>" class="btn btn-primary">
                    <?php echo $edit_item ? "Update Item" : "Add Item"; ?>
                </button>
                <?php if ($edit_item): ?>
                    <a href="manage_menu.php" class="btn btn-secondary ms-2">Cancel</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Item List -->
    <h2>Menu Items</h2>
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price (₹)</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($items) === 0): ?>
                <tr><td colspan="7" class="text-center">No menu items found.</td></tr>
            <?php else: ?>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['category_name']); ?></td>
                    <td><?php echo number_format($item['price'], 2); ?></td>
                    <td>
                        <?php if ($item['image']): ?>
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 80px; height: auto; border-radius: 5px;">
                        <?php else: ?>
                            No image
                        <?php endif; ?>
                    </td>
                    <td><?php echo $item['created_at']; ?></td>
                    <td>
                        <a href="manage_menu.php?edit_id=<?php echo $item['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="manage_menu.php?delete_id=<?php echo $item['id']; ?>" onclick="return confirm('Delete this item?');" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
