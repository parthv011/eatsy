<?php 
session_start();
require('header.php');

// Display cart messages
$cart_message = $_SESSION['cart_message'] ?? '';
$cart_error = $_SESSION['cart_error'] ?? '';
unset($_SESSION['cart_message'], $_SESSION['cart_error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Burgers - Food Paradise</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
body {
    background-color: #f1dcdcff; 
}

/* Cart Notification */
.cart-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1050;
    max-width: 350px;
}

/* Custom CSS for 3D effect */
.product-card-3d {
    border: 1px solid #ddd; 
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3), 
                -5px -5px 15px rgba(255, 255, 255, 0.8); 
    transform: perspective(1000px) rotateX(2deg) rotateY(-2deg); 
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    background-color: #f8f8f8; 
    border-radius: .5rem; 
    padding: 20px;
    width: 100%;
}

.product-card-3d:hover {
    transform: perspective(1000px) rotateX(0deg) rotateY(0deg) scale(1.01);
    box-shadow: 8px 8px 20px rgba(0, 0, 0, 0.4),
                -8px -8px 20px rgba(255, 255, 255, 0.9);
}

.product-image-container {
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

.product-image {
    max-width: 100%;
    height: auto;
    border-radius: .3rem; 
    box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2); 
}

.cart-btn {
    background: #e62e4a;
    border: none;
    color: white;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: bold;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.cart-btn:hover {
    background: #cf2941;
    color: white;
    transform: translateY(-2px);
}

.price-tag {
    color: #e62e4a;
    font-weight: bold;
}

.floating-cart {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
}

.cart-icon-btn {
    background: #e62e4a;
    color: white;
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    font-size: 1.5rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}

.cart-icon-btn:hover {
    background: #cf2941;
    transform: scale(1.1);
}

.cart-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: #ffc107;
    color: #000;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    font-size: 0.8rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
</head>
<body>

<!-- Cart Notification -->
<?php if ($cart_message): ?>
<div class="cart-notification">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i><?php echo htmlspecialchars($cart_message); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
<?php endif; ?>

<?php if ($cart_error): ?>
<div class="cart-notification">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i><?php echo htmlspecialchars($cart_error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
<?php endif; ?>

<div class="container my-5">
    <h1 class="text-center mb-5">Our Delightful Sliders</h1>
    
    <!-- Fluffy Bread With Crispy Crust -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="d-flex flex-column flex-md-row product-card-3d">
                <div class="col-md-5 p-3 product-image-container">
                    <img src="../includes/images/gb1.jpg" class="img-fluid product-image" alt="Fluffy Bread With Crispy Crust">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Fluffy Bread With Crispy Crust</h1>
                    <p class="lead">A delightful slider featuring fluffy bread with a crispy crust, filled with a variety of delicious ingredients.</p>
                    <h2 class="mb-4 price-tag">₹ 150.00</h2>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="../backend/add_to_cart.php?item=slider_fluffy_bread" class="cart-btn">
                            <i class="fas fa-shopping-cart me-2"></i>Add To Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Double Cheese Bread -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="d-flex flex-column flex-md-row product-card-3d">
                <div class="col-md-5 p-3 product-image-container">
                    <img src="../includes/images/gb2.jpg" class="img-fluid product-image" alt="Double Cheese Bread">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Double Cheese Bread</h1>
                    <p class="lead">A delicious slider featuring double layers of cheese, melted to perfection, and served on fluffy bread.</p>
                    <h2 class="mb-4 price-tag">₹ 200.00</h2>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="../backend/add_to_cart.php?item=slider_double_cheese" class="cart-btn">
                            <i class="fas fa-shopping-cart me-2"></i>Add To Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Margherita Cheese Bread-->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="d-flex flex-column flex-md-row product-card-3d">
                <div class="col-md-5 p-3 product-image-container">
                    <img src="../includes/images/gb3.jpg" class="img-fluid product-image" alt="Margherita Cheese Bread">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Margherita Cheese Bread</h1>
                    <p class="lead">A classic Margherita slider topped with fresh mozzarella, tomatoes, and basil on fluffy bread.</p>
                    <h2 class="mb-4 price-tag">₹ 200.00</h2>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="../backend/add_to_cart.php?item=slider_margherita_cheese" class="cart-btn">
                            <i class="fas fa-shopping-cart me-2"></i>Add To Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Crunchy Slices -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="d-flex flex-column flex-md-row product-card-3d">
                <div class="col-md-5 p-3 product-image-container">
                    <img src="../includes/images/gb4.jpg" class="img-fluid product-image" alt="Crunchy Slices">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Crunchy Slices</h1>
                    <p class="lead">A delightful combination of crispy vegetables and spices, served in a slider format for a fun and tasty bite.</p>
                    <h2 class="mb-4 price-tag">₹ 270.00</h2>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="../backend/add_to_cart.php?item=slider_crunchy" class="cart-btn">
                            <i class="fas fa-shopping-cart me-2"></i>Add To Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="floating-cart">
    <a href="cart.php" class="cart-icon-btn">
        <i class="fas fa-shopping-cart"></i>
        <?php if (isset($_SESSION['cart_count']) && $_SESSION['cart_count'] > 0): ?>
            <span class="cart-badge"><?php echo $_SESSION['cart_count']; ?></span>
        <?php endif; ?>
    </a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
