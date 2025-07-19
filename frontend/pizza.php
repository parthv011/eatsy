<?php require('../includes/header.php') ?>

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
        border: 1px solid #ddd; /* Light border */
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3), 
                    -5px -5px 15px rgba(255, 255, 255, 0.8); 
        transform: perspective(1000px) rotateX(2deg) rotateY(-2deg); 
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        background-color: #f5f3f2ff; 
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
        overflow: hidden; /* Ensures image doesn't overflow if slightly larger */
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
                    <img src="../includes/images/mpizza1.jpg" class="img-fluid product-image" alt="Margherita Pizza">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Margherita Pizza</h1>
                    <p class="lead">Its ingredients representing the colours of the Italian flag. These ingredients include red tomato sauce, white mozzarella and fresh green basil.</p>
                    <h2 class="mb-4">₹ 300.00</h2>
                    <div class="d-grid gap-2 d-md-block">
                         <a href="cart.php"><button class="btn btn-dark btn-lg">Add To Cart</button></a>
                        <a href="my_order.php"><button class="btn btn-dark btn-lg">Order Now</button></a>
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
                    <img src="../includes/images/mpizza2.jpg" class="img-fluid product-image" alt="Paneer Capsicum Pizza">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Paneer Capsicum Pizza</h1>
                    <p class="lead">This Indian-inspired option includes spiced paneer, onions, capsicum, red paprika, and mint mayonnaise on a tandoori sauce base with mozzarella cheese.</p>
                    <h2 class="mb-4">₹ 400.00</h2>
                    <div class="d-grid gap-2 d-md-block">
                         <a href="cart.php"><button class="btn btn-dark btn-lg">Add To Cart</button></a>
                        <a href="my_order.php"><button class="btn btn-dark btn-lg">Order Now</button></a>
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
                    <img src="../includes/images/mpizza3.jpg" class="img-fluid product-image" alt="Mexican Green Wave Pizza">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Mexican Green Wave Pizza</h1>
                    <p class="lead">This flavor-packed pizza features crunchy onions, crisp capsicum, juicy tomatoes, and jalapenos, all topped with exotic Mexican herbs and a liberal sprinkling of cheese.</p>
                    <h2 class="mb-4">₹ 450.00</h2>
                    <div class="d-grid gap-2 d-md-block">
                         <a href="cart.php"><button class="btn btn-dark btn-lg">Add To Cart</button></a>
                        <a href="my_order.php"><button class="btn btn-dark btn-lg">Order Now</button></a>
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
                    <img src="../includes/images/mpizza4.png" class="img-fluid product-image" alt="Cheese & Corn Pizza">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Cheese & Corn Pizza</h1>
                    <p class="lead">A simple combination of cheese and golden corn.Fresh Veggie: Typically includes onion and capsicum.</p>
                    <h2 class="mb-4">₹ 360.00</h2>
                    <div class="d-grid gap-2 d-md-block">
                         <a href="cart.php"><button class="btn btn-dark btn-lg">Add To Cart</button></a>
                        <a href="my_order.php"><button class="btn btn-dark btn-lg">Order Now</button></a>
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
                    <img src="../includes/images/mpizza5.jpg" class="img-fluid product-image" alt="Pesto Pizza">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Pesto Pizza</h1>
                    <p class="lead">Uses pesto as the sauce base, often paired with vegetables like roasted red peppers, mushrooms, and asparagus.</p>
                    <h2 class="mb-4">₹ 420.00</h2>
                    <div class="d-grid gap-2 d-md-block">
                         <a href="cart.php"><button class="btn btn-dark btn-lg">Add To Cart</button></a>
                        <a href="my_order.php"><button class="btn btn-dark btn-lg">Order Now</button></a>
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
                    <img src="../includes/images/mpizza6.jpg" class="img-fluid product-image" alt="Peppy Paneer Pizza">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Peppy Paneer Pizza</h1>
                    <p class="lead">Chunky paneer with capsicum and spicy red pepper.</p>
                    <h2 class="mb-4">₹ 530.00</h2>
                    <div class="d-grid gap-2 d-md-block">
                         <a href="cart.php"><button class="btn btn-dark btn-lg">Add To Cart</button></a>
                        <a href="my_order.php"><button class="btn btn-dark btn-lg">Order Now</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php require('../includes/footer.php') ?>
</body>
</html>