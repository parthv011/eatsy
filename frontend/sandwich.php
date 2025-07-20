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
                    <img src="../includes/images/ms1.jpg" class="img-fluid product-image" alt="Aloo Masala Sandwich">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Aloo Masala Sandwich</h1>
                    <p class="lead">A hearty option, featuring a spicy mashed potato filling seasoned with Indian spices like red chili powder, turmeric, and coriander, often accompanied by peas, green chilies, and coriander leaves. It's typically grilled or toasted.</p>
                    <h2 class="mb-4">₹ 120.00</h2>
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
                    <img src="../includes/images/ms2.jpg" class="img-fluid product-image" alt="Paneer Tikka Sandwich">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Paneer Tikka Sandwich</h1>
                    <p class="lead">This fusion sandwich incorporates marinated and grilled paneer (Indian cottage cheese) cubes with vegetables and a spicy green chutney.</p>
                    <h2 class="mb-4">₹ 200.00</h2>
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
                    <img src="../includes/images/vgs.jpeg" class="img-fluid product-image" alt="Vegetable Grilled Sandwich">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Vegetable Grilled Sandwich</h1>
                    <p class="lead">A healthy and satisfying sandwich filled with a variety of fresh vegetables like onions, tomatoes, cucumbers, bell peppers, sometimes beets, and cheese, all grilled to a crispy texture with a flavorful chutney spread.</p>
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
                    <img src="../includes/images/ms4.jpg" class="img-fluid product-image" alt="Vegetable Cheese Sandwich">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Vegetable Cheese Sandwich</h1>
                    <p class="lead">This sandwich combines the creamy indulgence of cheese (like mozzarella or cheddar) with a mix of fresh vegetables like carrots, bell peppers, corn, and onions, flavored with herbs and spices. It's typically grilled until the cheese melts.</p>
                    <h2 class="mb-4">₹ 180.00</h2>
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
                    <img src="../includes/images/ms5.jpg" class="img-fluid product-image" alt="Curd Sandwich">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Curd Sandwich</h1>
                    <p class="lead">Made with thick hung curd (strained yogurt) mixed with finely chopped vegetables like onions, capsicum, cucumber, corn, and seasonings like black pepper and salt. It can be eaten as a cold sandwich or grilled.</p>
                    <h2 class="mb-4">₹ 140.00</h2>
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