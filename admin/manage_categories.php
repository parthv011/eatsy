<?php 
session_start(); 
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: admin_login.php");  
    exit(); 
} 

require_once '../includes/db.php'; 

// Create uploads directory if it doesn't exist
$upload_dir = '../includes/uploads/categories/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if (isset($_POST['add_category'])) {   
    $name = trim($_POST['category_name']); 
    $image_path = '';
    
    if ($name != '') {   
        // Handle file upload
        if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] == 0) {
            $allowed = array('jpg', 'jpeg', 'png', 'gif');
            $filename = $_FILES['category_image']['name'];
            $filetype = pathinfo($filename, PATHINFO_EXTENSION);
            
            if (in_array(strtolower($filetype), $allowed)) {
                // Generate unique filename
                $new_filename = uniqid() . '.' . $filetype;
                $upload_path = $upload_dir . $new_filename;
                
                if (move_uploaded_file($_FILES['category_image']['tmp_name'], $upload_path)) {
                    $image_path = 'includes/uploads/categories/' . $new_filename;
                }
            }
        }
        
        $stmt = $conn->prepare("INSERT INTO categories (name, image) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $image_path); 
        $stmt->execute(); 
    } 
    header("Location: manage_categories.php");
    exit(); 
} 

// Handle Delete 
if (isset($_GET['delete'])) { 
    $id = intval($_GET['delete']);
    
    // Get image path before deleting
    $result = $conn->query("SELECT image FROM categories WHERE id = $id");
    if ($row = $result->fetch_assoc()) {
        if ($row['image'] && file_exists('../' . $row['image'])) {
            unlink('../' . $row['image']); // Delete the file
        }
    }
    
    $conn->query("DELETE FROM categories WHERE id = $id");
    header("Location: manage_categories.php"); 
    exit(); 
} 

// Fetch all categories 
$categories = $conn->query("SELECT * FROM categories ORDER BY id DESC"); 
?> 

<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="container mt-4"> 
    <h3>Manage Categories</h3> 
    
    <!-- Add Category Form -->
    <form method="post" enctype="multipart/form-data" class="row g-3 mb-4"> 
        <div class="col-md-4"> 
            <input type="text" name="category_name" class="form-control" placeholder="Category name" required> 
        </div>
        <div class="col-md-4">
            <input type="file" name="category_image" class="form-control" accept="image/*" required> 
        </div>
        <div class="col-md-4"> 
            <button type="submit" name="add_category" class="btn btn-primary w-100">Add Category</button> 
        </div> 
    </form>

    <!-- Categories Table -->
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $categories->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td>
                    <?php if ($row['image'] && file_exists('../' . $row['image'])): ?>
                        <img src="../<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" height="50" style="object-fit: cover;">
                    <?php else: ?>
                        <span class="text-muted">No image</span>
                    <?php endif; ?>
                </td>
                <td><?= $row['created_at'] ?></td>
                <td>
                    <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div> 

<?php include '../includes/footer.php'; ?>