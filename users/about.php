<?php require('header.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Food Ordering Site</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS for Inter font and general styling -->
    <style>
        body {
            /* font-family: 'Inter', sans-serif; */
            background-color: #f7ece3ff; /* Light grey background */
            /* color: #343a40; Dark grey text */
        }
        .navbar {
            background-color: #dc3545; /* Red color for navbar */
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important; /* White text for navbar items */
            font-weight: 600;
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #f8d7da !important; /* Lighter red on hover */
        }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://placehold.co/1200x400/343a40/ffffff?text=Delicious+Food') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
            text-align: center;
            /* border-radius: 0 0 15px 15px; Rounded bottom corners */
            margin-bottom: 30px;
            width: 100%;
            height: 300px;
        }
        .hero-section h1 {
            font-size: 3.5rem;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        .hero-section p {
            font-size: 1.25rem;
            max-width: 700px;
            margin: 0 auto;
        }
        .about-content-section {
            padding: 40px 0;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,.05);
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background-color: #bcd1e8ff; /* Blue header */
            color: black;
            font-weight: 600;
            border-radius: 15px 15px 0 0 !important;
        }
        .team-member img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #dc3545; /* Red border */
            margin-bottom: 15px;
        }
        .footer {
            background-color: #343a40; /* Dark grey footer */
            color: white;
            padding: 30px 0;
            margin-top: 50px;
            border-radius: 15px 15px 0 0; /* Rounded top corners */
        }
        .footer a {
            color: #ffc107; /* Yellow links */
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
        </div>
    </section>

    <!-- About Content Section -->
    <section class="about-content-section">
        <div class="container">
            <div class="row g-4">
                <!-- Our Story Card -->
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            Our Story
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">From a Dream to Your Table</h5>
                            <p class="card-text">Foodie Delight started with a simple idea: to make high-quality, delicious meals accessible to everyone, everywhere. Founded in 2020 by a group of food enthusiasts, we began as a small local delivery service. Through dedication to taste, quality ingredients, and customer satisfaction, we've grown into a beloved food ordering platform serving thousands of happy customers daily.</p>
                            <p class="card-text">Our journey has been fueled by a love for culinary arts and a commitment to bringing joy through food. Every dish on our menu is carefully selected and prepared to ensure a delightful experience for you.</p>
                        </div>
                    </div>
                </div>

                <!-- Our Mission Card -->
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            Our Mission
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Delivering Happiness, One Meal at a Time</h5>
                            <p class="card-text">Our mission is to provide an unparalleled food ordering experience that combines convenience, variety, and exceptional quality. We strive to:</p>
                            <ul>
                                <li><strong>Delight Your Taste Buds:</strong> Offer a diverse menu of delicious, freshly prepared meals.</li>
                                <li><strong>Ensure Convenience:</strong> Provide a seamless and user-friendly ordering and delivery process.</li>
                                <li><strong>Prioritize Quality:</strong> Partner with the best local restaurants and use fresh, high-quality ingredients.</li>
                                <li><strong>Foster Community:</strong> Support local businesses and create a platform that connects food lovers with great food.</li>
                            </ul>
                            <p class="card-text">We believe that every meal is an opportunity to create a memorable moment, and we are here to make that happen for you.</p>
                        </div>
                    </div>
                </div>

                <!-- Our Values Card -->
                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-header">
                            Our Values
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">The Principles That Guide Us</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h6><i class="bi bi-heart-fill me-2"></i>Quality & Freshness</h6>
                                    <p>We are committed to sourcing the freshest ingredients and partnering with restaurants that uphold the highest standards of food preparation.</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h6><i class="bi bi-lightning-fill me-2"></i>Customer Satisfaction</h6>
                                    <p>Your happiness is our top priority. We go the extra mile to ensure every order is perfect and every customer is satisfied.</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h6><i class="bi bi-truck me-2"></i>Efficiency & Reliability</h6>
                                    <p>We pride ourselves on fast, reliable delivery and a smooth ordering process, making your experience hassle-free.</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h6><i class="bi bi-hand-thumbs-up-fill me-2"></i>Innovation</h6>
                                    <p>We continuously seek new ways to improve our platform, expand our menu, and enhance the overall customer experience.</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h6><i class="bi bi-people-fill me-2"></i>Community Focus</h6>
                                    <p>We believe in supporting local businesses and contributing positively to the communities we serve.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Team Section -->
            <div class="row mt-5 text-center">
                <div class="col-12">
                    <h2>Meet Our Team</h2>
                    <p class="lead">The dedicated individuals behind Foodie Delight, working to bring you the best food experience.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="team-member card p-4 h-100">
                        <img src="https://placehold.co/150x150/007bff/ffffff?text=John+D" alt="John Doe" class="mx-auto d-block">
                        <h5>John Doe</h5>
                        <p class="text-muted">CEO & Founder</p>
                        <p class="small">Visionary leader passionate about technology and food. John guides our strategic direction.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="team-member card p-4 h-100">
                        <img src="https://placehold.co/150x150/28a745/ffffff?text=Jane+S" alt="Jane Smith" class="mx-auto d-block">
                        <h5>Jane Smith</h5>
                        <p class="text-muted">Head Chef & Menu Curator</p>
                        <p class="small">Culinary expert ensuring every dish meets our high standards of taste and quality.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="team-member card p-4 h-100">
                        <img src="https://placehold.co/150x150/ffc107/ffffff?text=Mike+W" alt="Mike Williams" class="mx-auto d-block">
                        <h5>Mike Williams</h5>
                        <p class="text-muted">Operations Manager</p>
                        <p class="small">Ensures smooth daily operations, from order processing to timely deliveries.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Bootstrap Icons (optional, but good for values section) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<?php require('footer.php')?>

</body>
</html>
