<?php require('header.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pizza</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  body {
      background-color: #f1dcdcff; 
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

    /* Adjustments for the content within the 3D box */
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
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10"> <div class="d-flex flex-column flex-md-row product-card-3d">
                <div class="col-md-5 p-3 product-image-container">
                    <img src="../includes/images/gb1.jpg" class="img-fluid product-image" alt="Fluffy Bread With Crispy Crust">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Fluffy Bread With Crispy Crust</h1>
                    <p class="lead">Its ingredients representing the colours of the Italian flag. These ingredients include white sauce, white mozzarella and fresh green basil.</p>
                    <h2 class="mb-4">₹ 210.00</h2>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="cart.php"><button class="btn btn-dark btn-lg">Add To Cart</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10"> <div class="d-flex flex-column flex-md-row product-card-3d">
                <div class="col-md-5 p-3 product-image-container">
                    <img src="../includes/images/gb2.jpg" class="img-fluid product-image" alt="Double Cheese Bread">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Double Cheese Bread</h1>
                    <p class="lead">includes spiced garlic, onions, capsicum, red paprika, and mint mayonnaise on a tandoori sauce base with mozzarella cheese.</p>
                    <h2 class="mb-4">₹ 190.00</h2>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="cart.php"><button class="btn btn-dark btn-lg">Add To Cart</button></a>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10"> <div class="d-flex flex-column flex-md-row product-card-3d">
                <div class="col-md-5 p-3 product-image-container">
                    <img src="../includes/images/gb3.jpg" class="img-fluid product-image" alt="Margherita Cheese Bread">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Margherita Cheese Bread</h1>
                    <p class="lead">This flavor-packed margherita pizza features crunchy onions, crisp capsicum, juicy tomatoes, and jalapenos, all topped with exotic Mexican herbs and a liberal sprinkling of cheese.</p>
                    <h2 class="mb-4">₹ 250.00</h2>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="cart.php"><button class="btn btn-dark btn-lg">Add To Cart</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10"> <div class="d-flex flex-column flex-md-row product-card-3d">
                <div class="col-md-5 p-3 product-image-container">
                    <img src="../includes/images/gb4.jpg" class="img-fluid product-image" alt="Crunchy Slices">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Crunchy Slices</h1>
                    <p class="lead">A simple combination of cheese Typically includes garlic and white sauce.</p>
                    <h2 class="mb-4">₹ 160.00</h2>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="cart.php"><button class="btn btn-dark btn-lg">Add To Cart</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php require('footer.php') ?>
</body>
</html>