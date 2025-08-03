<?php 
    require 'header.php';
    require_once '../includes/db.php'; // Fetch all categories 
    $categories = $conn->query("SELECT * FROM categories ORDER BY id DESC"); 
?> 
<!DOCTYPE html> <html lang="en"> 
<head> <meta charset="UTF-8" /> 
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
      <title>Menu Page</title> 
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/> 
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> 
      <style> 
      body {
            background-color: #f7ece3ff; 
            min-height: 100vh; 
        }
        .menu-section {
            padding-top: 50px; 
            padding-bottom: 50px; 
        }
        .custom-card {
            border: none; 
            border-radius: 10px; 
            overflow: hidden; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.08); 
            margin-bottom: 30px;
        }
        .custom-card .card-img-top {
            border-radius: 10px 10px 0 0; 
            height: 290px; 
            object-fit: cover; 
        }
        .card-img-overlay-custom {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            padding: 15px; 
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            z-index: 1;
        }
        .card-img-overlay-custom .price-badge {
            background-color: rgba(0, 0, 0, 0.7); /* Dark semi-transparent background */
            color: #fff;
            padding: 6px 12px; /* Slightly larger padding for badge */
            border-radius: 5px;
            font-weight: bold;
            font-size: 0.95rem;
        }
        .card-img-overlay-custom .cart-icon-btn {
            background-color: rgba(255, 255, 255, 0.9); /* White semi-transparent background */
            color: #333;
            border: none;
            border-radius: 50%;
            width: 38px; /* Slightly larger button */
            height: 38px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Small shadow for the button */
        }
        .custom-card .card-body {
            padding: 20px;
            background-color: #fff; /* White background for card body */
        }
        .custom-card .card-title {
            font-size: 1.5rem;
            font-weight: 700; /* Bolder title */
            color: #333;
            margin-bottom: 10px;
        }
        .custom-card .card-text {
            font-size: 0.9rem;
            color: #666;
            line-height: 1.5;
            min-height: 70px; /* Ensure consistent height for descriptions */
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Limit description to 3 lines */
            -webkit-box-orient: vertical;
        }
        .delivery-info {
            font-size: 0.9rem;
            color: #888;
            margin-top: 15px;
            padding-bottom: 15px; 
            border-bottom: 1px solid #eee; 
            margin-bottom: 15px; 
        }
        .quantity-controls .input-group-text {
            background-color: #f8f9fa; /* Lighter background for quantity display */
            border: 1px solid #e9ecef;
            color: #555;
            min-width: 45px; /* Ensure uniform width */
            justify-content: center;
            font-weight: 500;
        }
        .quantity-controls .btn-outline-secondary {
            border-color: #e9ecef;
            color: #555;
            background-color: #f2f2f2;
            padding: 0.375rem 0.75rem; /* Standard button padding */
        }
        .quantity-controls .btn-outline-secondary:hover {
            background-color: #e2e6ea;
            border-color: #dae0e5;
        }
        .order-button-group {
            background-color: #fff; 
            padding: 0 20px 20px; 
        }
        .order-button-group .btn-primary {
            background-color: #e62e4a;
            border-color: #e62e4a;
            font-weight: bold;
            padding: 10px 0; /* Vertical padding */
            font-size: 1.1rem;
            border-radius: 8px; 
        }
        .order-button-group .btn-primary:hover {
            background-color: #cf2941;
            border-color: #be253a;
        }

      </style> 
</head> 
<body> 
    <div class="container menu-section"> 
    <div class="row">
<?php 
while ($cat = $categories->fetch_assoc()): 
?>
  <div class="col-md-6 col-lg-4">
    <div class="card custom-card">
      <div class="position-relative">
        <img src="<?= htmlspecialchars($cat['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($cat['name']) ?>">
      </div>
      <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($cat['name']) ?></h5>
        <p class="card-text">
          <?= htmlspecialchars($cat['description'] ?: 'Explore our variety of delicious items in this category.') ?>
        </p>
      </div>
      <div class="order-button-group text-center">
        <a href="menu_item.php?category_id=<?= $cat['id'] ?>">
          <button class="btn btn-primary w-100">Menu</button>
        </a>
      </div>
    </div>
  </div>
<?php endwhile; ?>
</div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> <?php require('footer.php') ?> </body> </html>