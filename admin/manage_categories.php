<?php session_start(); 
if (!isset($_SESSION['admin_logged_in'])) 
    { header("Location: admin_login.php");  
      exit(); 
    } 
require_once '../includes/db.php'; 
if (isset($_POST['add_category'])) 
{   $name = trim($_POST['category_name']); 
    $image = trim($_POST['category_image']); // You can also implement file uploads later 
    if ($name != '') 
    {   
      $stmt = $conn->prepare("INSERT INTO categories (name, image) VALUES (?, ?)");
      $stmt->bind_param("ss", $name, $image); $stmt->execute(); 
    } 
    header("Location: manage_categories.php");
    exit(); 
} // Handle Delete 
if (isset($_GET['delete']))
    { 
        $id = intval($_GET['delete']);
         $conn->query("DELETE FROM categories WHERE id = $id");
        header("Location: manage_categories.php"); exit(); 
    } // Fetch all categories 
$categories = $conn->query("SELECT * FROM categories ORDER BY id DESC"); 
?> 
<?php include '../includes/header.php'; ?>
 <?php include '../includes/sidebar.php'; ?>
  <div class="container mt-4"> <h3>Manage Categories</h3> 
  <form method="post" class="row g-3 mb-4"> 
    <div class="col-md-4"> 
        <input type="text" name="category_name" class="form-control" placeholder="Category name" required> </div>
         <div class="col-md-4"></div><input type="file" name="category_image" accept="image/*" required> </div>
         <div class="col-md-4"> <button type="submit" name="add_category" class="btn btn-primary w-100">Add Category</button> </div> </form>
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
                <?php if ($row['image']): ?>
                    <img src="<?= $row['image'] ?>" alt="<?= $row['name'] ?>" height="50">
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