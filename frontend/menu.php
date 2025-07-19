<?php require('header.php') ?>

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
                        <img src="images/mpizza1.jpg" class="card-img-top" alt="pizza">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 300.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Margherita Pizza</h5>
                        <p class="card-text">Its ingredients representing the colours of the Italian flag. These ingredients include red tomato sauce, white mozzarella and fresh green basil.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                       <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/mpizza2.jpg" class="card-img-top" alt="Chicken Alfredo">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 400.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Paneer Capsicum</h5>
                        <p class="card-text">This Indian-inspired option includes spiced paneer, onions, capsicum, red paprika, and mint mayonnaise on a tandoori sauce base with mozzarella cheese.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                         <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/mpizza3.jpg" class="card-img-top" alt="Margherita Pizza">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 450.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Mexican Green Wave</h5>
                        <p class="card-text">This flavor-packed pizza features crunchy onions, crisp capsicum, juicy tomatoes, and jalapenos, all topped with exotic Mexican herbs and a liberal sprinkling of cheese.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/mpizza4.png" class="card-img-top" alt="Veggie Burger">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 360.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Cheese & Corn</h5>
                        <p class="card-text">A simple combination of cheese and golden corn.Fresh Veggie: Typically includes onion and capsicum.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/mpizza5.jpg" class="card-img-top" alt="Caesar Salad">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 420.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Pesto Pizza</h5>
                        <p class="card-text">Uses pesto as the sauce base, often paired with vegetables like roasted red peppers, mushrooms, and asparagus.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/mpizza6.jpg" class="card-img-top" alt="Chocolate Cake">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 530.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Peppy Paneer</h5>
                        <p class="card-text">Chunky paneer with capsicum and spicy red pepper.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/mbg1.jpg" class="card-img-top" alt="pizza">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 150.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Aloo Tikki Burger</h5>
                        <p class="card-text">A classic Indian favorite featuring a spiced potato patty (aloo tikki), typically topped with onions, tomatoes, and chutney in a bun.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/mbg2.jpg" class="card-img-top" alt="Chicken Alfredo">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 200.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Cheeze Paneer</h5>
                        <p class="card-text">A burger with a paneer (Indian cottage cheese) patty, often grilled or shallow fried, and spiced according to preference.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/mbg3.jpg" class="card-img-top" alt="Margherita Pizza">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 180.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Mix Vegetable Burger</h5>
                        <p class="card-text">A patty made from various steamed or sautéed vegetables like potatoes, carrots, peas, beans, and cauliflower, spiced with Indian masalas like garam masala and cumin.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/mbg4.jpg" class="card-img-top" alt="Veggie Burger">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 270.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Black Bean Burger</h5>
                        <p class="card-text">A popular Western import, often made with black beans and other ingredients, sometimes with an Indian twist like spicy mayo or avocado and mango.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/mbg5.jpg" class="card-img-top" alt="Caesar Salad">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 300.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Tofu Burger</h5>
                        <p class="card-text">A vegan-friendly option, with a patty made from tofu, sometimes crumbled or grated, and used as a substitute for paneer or cheese.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/mbg6.jpg" class="card-img-top" alt="Chocolate Cake">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 330.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Lentil Burger</h5>
                        <p class="card-text">Patties made from lentils, often spiced with Indian masalas, and served in a bun or wrapped in lettuce.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/ms1.jpg" class="card-img-top" alt="pizza">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 120.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Aloo Masala Sandwich</h5>
                        <p class="card-text">A hearty option, featuring a spicy mashed potato filling seasoned with Indian spices like red chili powder, turmeric, and coriander, often accompanied by peas, green chilies, and coriander leaves.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/ms2.jpg" class="card-img-top" alt="Chicken Alfredo">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 200.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Paneer Tikka Sandwich</h5>
                        <p class="card-text">This fusion sandwich incorporates marinated and grilled paneer (Indian cottage cheese) cubes with vegetables and a spicy green chutney.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/ms3" class="card-img-top" alt="Margherita Pizza">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 150.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Vagetable Grilled Sandwich</h5>
                        <p class="card-text">A healthy and satisfying sandwich filled with a variety of fresh vegetables like onions, tomatoes, cucumbers, bell peppers, sometimes beets, and cheese, all grilled to a crispy texture with a flavorful chutney spread.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/ms4.jpg" class="card-img-top" alt="Veggie Burger">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 180.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Vagetable Cheese Sandwich</h5>
                        <p class="card-text">This sandwich combines the creamy indulgence of cheese (like mozzarella or cheddar) with a mix of fresh vegetables like carrots, bell peppers, corn, and onions, flavored with herbs and spices. It's typically grilled until the cheese melts.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/ms5.jpg" class="card-img-top" alt="Caesar Salad">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 140.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Curd Sandwich</h5>
                        <p class="card-text">Made with thick hung curd (strained yogurt) mixed with finely chopped vegetables like onions, capsicum, cucumber, corn, and seasonings like black pepper and salt. It can be eaten as a cold sandwich or grilled.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/mt1.jpg" class="card-img-top" alt="Chocolate Cake">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 300.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Paneer Tacos</h5>
                        <p class="card-text">Its ingredients representing the paneer and chhese with sous or many items.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/mt2.jpg" class="card-img-top" alt="Chocolate Cake">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 240.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Vagetable Tacos</h5>
                        <p class="card-text">This Indian-inspired option includes spiced, onions, capsicum, red paprika, and mint mayonnaise on a tandoori sauce base with mozzarella cheese.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/mt3.jpg" class="card-img-top" alt="Chocolate Cake">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 450.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Black Bean Tacos</h5>
                        <p class="card-text">This flavor-packed bean features crunchy onions, crisp capsicum, juicy tomatoes, and jalapenos, all topped with exotic Mexican herbs and a liberal sprinkling of cheese.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/mt4.jpg" class="card-img-top" alt="Chocolate Cake">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 360.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Garlic Butter Tacos</h5>
                        <p class="card-text">A simple combination of cheese and garlic with butter Typically includes onion and capsicum.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/gb1.jpg" class="card-img-top" alt="Chocolate Cake">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 210.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Fluffy & Crispy Crust</h5>
                        <p class="card-text">Its ingredients representing the colours of the Italian flag. These ingredients include white sauce, white mozzarella and fresh green basil.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/gb2.jpg" class="card-img-top" alt="Chocolate Cake">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 190.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Double Cheese Bread</h5>
                        <p class="card-text">includes spiced garlic, onions, capsicum, red paprika, and mint mayonnaise on a tandoori sauce base with mozzarella cheese.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/gb3.jpg" class="card-img-top" alt="Chocolate Cake">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 250.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Margherita Cheese Bread</h5>
                        <p class="card-text">This flavor-packed margherita pizza features crunchy onions, crisp capsicum, juicy tomatoes, and jalapenos, all topped with exotic Mexican herbs and a liberal sprinkling of cheese.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/gb4.jpg" class="card-img-top" alt="Chocolate Cake">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 160.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Crunchy Slices</h5>
                        <p class="card-text">A simple combination of cheese Typically includes garlic and white sauce.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/md1.jpg" class="card-img-top" alt="Chocolate Cake">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 280.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Chocolate Milkshake</h5>
                        <p class="card-text">A timeless favorite, the classic chocolate milkshake is a smooth and creamy blend of chocolate ice cream, milk, and often a dash of chocolate syrup or cocoa powder.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/md2.jpg" class="card-img-top" alt="Chocolate Cake">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 260.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Mango Milkshake</h5>
                        <p class="card-text">A particularly beloved summer shake, it combines the sweetness of ripe mangoes with chilled milk and sometimes a hint of cardamom, offering a tropical and refreshing taste.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/md3.jpg" class="card-img-top" alt="Chocolate Cake">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 230.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Strawberry Milkshake</h5>
                        <p class="card-text">A fruity and vibrant choice, this milkshake combines fresh or frozen strawberries with milk, and often strawberry ice cream, for a delightful sweet and tangy flavor profile.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/md4.jpg" class="card-img-top" alt="Chocolate Cake">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 150.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Vanilla Milkshake</h5>
                        <p class="card-text">A simple yet elegant classic, the vanilla milkshake showcases the pure essence of vanilla blended with creamy vanilla ice cream and milk.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card custom-card">
                    <div class="position-relative">
                        <img src="images/md5.jpg" class="card-img-top" alt="Chocolate Cake">
                        <div class="card-img-overlay-custom">
                            <span class="price-badge">₹ 260.00</span>
                            <button class="btn cart-icon-btn"><i class="fas fa-shopping-basket"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Milky Coffee</h5>
                        <p class="card-text">A caffeine kick in milkshake form, it's typically made with coffee ice cream or brewed coffee, milk, and can be customized with chocolate syrup for a mocha variation or other flavorings for a cappuccino twist.</p>
                        <div class="d-flex justify-content-between align-items-center delivery-info">
                            <span>delivery fee <strong>₹ 50.00</strong></span>
                            <div class="input-group input-group-sm quantity-controls w-auto">
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-minus"></i></button>
                                <span class="input-group-text">1</span>
                                <button class="btn btn-outline-secondary" type="button"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="order-button-group text-center">
                        <a href="my_order.php"><button class="btn btn-primary w-100">Order Now</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <?php require('footer.php') ?>
</body>
</html>