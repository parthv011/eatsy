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
                    <img src="../includes/images/md1.jpg" class="img-fluid product-image" alt="Chocolate Milkshake">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Chocolate Milkshake</h1>
                    <p class="lead">A timeless favorite, the classic chocolate milkshake is a smooth and creamy blend of chocolate ice cream, milk, and often a dash of chocolate syrup or cocoa powder.</p>
                    <h2 class="mb-4">₹ 280.00</h2>
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
                    <img src="../includes/images/md2.jpg" class="img-fluid product-image" alt="Mango Milkshake">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Mango Milkshake</h1>
                    <p class="lead">A particularly beloved summer shake, it combines the sweetness of ripe mangoes with chilled milk and sometimes a hint of cardamom, offering a tropical and refreshing taste.</p>
                    <h2 class="mb-4">₹ 260.00</h2>
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
                    <img src="../includes/images/md3.jpg" class="img-fluid product-image" alt="Strawberry Milkshake">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Strawberry Milkshake</h1>
                    <p class="lead">A fruity and vibrant choice, this milkshake combines fresh or frozen strawberries with milk, and often strawberry ice cream, for a delightful sweet and tangy flavor profile.</p>
                    <h2 class="mb-4">₹ 230.00</h2>
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
                    <img src="../includes/images/md4.jpg" class="img-fluid product-image" alt="Vanilla Milkshake">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Vanilla Milkshake</h1>
                    <p class="lead"> A simple yet elegant classic, the vanilla milkshake showcases the pure essence of vanilla blended with creamy vanilla ice cream and milk.</p>
                    <h2 class="mb-4">₹ 150.00</h2>
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
                    <img src="../includes/images/md5.jpg" class="img-fluid product-image" alt="Milky Coffee">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Milky Coffee</h1>
                    <p class="lead">A caffeine kick in milkshake form, it's typically made with coffee ice cream or brewed coffee, milk, and can be customized with chocolate syrup for a mocha variation or other flavorings for a cappuccino twist.</p>
                    <h2 class="mb-4">₹ 260.00</h2>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="cart.php"><button class="btn btn-dark btn-lg">Add To Cart</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php require('footer.php') ?>
</body>
</html>