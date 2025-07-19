<?php require('../includes/header.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="../includes/images/mpizza1.jpg" class="card-img-top" alt="pizza">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 300.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Pizza</h5>
                        <p class="card-text">Its ingredients representing the colours of the Italian flag. These ingredients include red tomato sauce, white mozzarella and fresh green basil.</p>
                    </div>
                    <div class="order-button-group text-center">
                       <a href="pizza.php"><button class="btn btn-primary w-100">Menu</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="../includes/images/mbg1.jpg" class="card-img-top" alt="pizza">
                        <div class="card-img-overlay-custom">
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Burger</h5>
                        <p class="card-text">A classic Indian favorite featuring a spiced potato patty, typically topped with onions, tomatoes, and chutney in a bun.</p>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="burger.php"><button class="btn btn-primary w-100">Menu</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="../includes/images/ms1.jpg" class="card-img-top" alt="pizza">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Sandwich</h5>
                        <p class="card-text">A hearty option, featuring a spicy mashed potato filling seasoned with Indian spices like red chili powder, turmeric, and coriander, often accompanied by peas, green chilies, and coriander leaves.</p>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="Sandwich.php"><button class="btn btn-primary w-100">Menu</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="../includes/images/mt1.jpg" class="card-img-top" alt="Chocolate Cake">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Tacos</h5>
                        <p class="card-text">Its ingredients representing the paneer and cheese with sauce or many items.</p>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="tacos.php"><button class="btn btn-primary w-100">Menu</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="../includes/images/gb1.jpg" class="card-img-top" alt="Chocolate Cake">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Sliders</h5>
                        <p class="card-text">Its ingredients representing the colours of the Italian flag. These ingredients include white sauce, white mozzarella and fresh green basil.</p>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="gb.php"><button class="btn btn-primary w-100">Menu</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="../includes/images/md1.jpg" class="card-img-top" alt="Chocolate Cake">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Shakes and Cold Drinks</h5>
                        <p class="card-text">A timeless favorite, the classic chocolate milkshake is a smooth and creamy blend of chocolate ice cream, milk, and often a dash of chocolate syrup or cocoa powder.</p>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="cold.php"><button class="btn btn-primary w-100">Menu</button></a>
                    </div>
                </div>
            </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php require('../includes/footer.php') ?>
</body>
</html>