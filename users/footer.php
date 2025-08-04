<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Website</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #2c3e50;
            --accent-color: #f39c12;
            --light-bg: #f8f9fa;
            --dark-bg: #1a1a1a;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .demo-section {
            padding: 40px 0;
            background: #f8f9fa;
        }
        
        .demo-title {
            text-align: center;
            margin-bottom: 30px;
            color: var(--secondary-color);
            font-weight: bold;
        }
        
        /* Footer Style 1 - Classic Restaurant Footer */
        .footer-classic {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #34495e 100%);
            color: white;
            padding: 60px 0 0;
            position: relative;
            overflow: hidden;
        }
        
        .footer-classic::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color), var(--primary-color));
        }
        
        .footer-classic .footer-brand {
            font-size: 2rem;
            font-weight: bold;
            color: var(--accent-color);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .footer-classic .footer-description {
            color: #bdc3c7;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        
        .footer-classic h5 {
            color: var(--accent-color);
            font-weight: bold;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-classic h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--primary-color);
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .footer-links a:hover {
            color: var(--accent-color);
            transform: translateX(5px);
        }
        
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }
        
        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        
        .social-icons a:hover {
            background: var(--accent-color);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.3);
        }
        
        .contact-info {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .contact-info li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #bdc3c7;
        }
        
        .contact-info i {
            color: var(--primary-color);
            font-size: 1.1rem;
            width: 20px;
        }
        
        .newsletter-form {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 25px;
            margin-top: 20px;
        }
        
        .newsletter-form h6 {
            color: var(--accent-color);
            margin-bottom: 15px;
            font-weight: bold;
        }
        
        .newsletter-form .input-group {
            margin-top: 15px;
        }
        
        .newsletter-form .form-control {
            border: none;
            background: rgba(255,255,255,0.9);
            border-radius: 25px 0 0 25px;
            padding: 12px 20px;
        }
        
        .newsletter-form .btn {
            background: var(--primary-color);
            border: none;
            border-radius: 0 25px 25px 0;
            padding: 12px 25px;
            font-weight: bold;
        }
        
        .newsletter-form .btn:hover {
            background: var(--accent-color);
        }
        
        .footer-bottom {
            background: rgba(0,0,0,0.2);
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: 40px;
            padding: 25px 0;
            text-align: center;
        }
        
        .footer-bottom-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 10px;
            flex-wrap: wrap;
        }
        
        .footer-bottom-links a {
            color: #bdc3c7;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }
        
        .footer-bottom-links a:hover {
            color: var(--accent-color);
        }
        
        /* Footer Style 2 - Modern Minimalist */
        .footer-modern {
            background: var(--dark-bg);
            color: white;
            padding: 70px 0 0;
            position: relative;
        }
        
        .footer-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
        }
        
        .footer-modern .section-divider {
            width: 60px;
            height: 3px;
            background: var(--primary-color);
            margin: 0 auto 40px;
        }
        
        .footer-modern .footer-widget {
            margin-bottom: 40px;
        }
        
        .footer-modern .widget-title {
            color: white;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .footer-modern .recipe-preview {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding: 15px;
            background: rgba(255,255,255,0.05);
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .footer-modern .recipe-preview:hover {
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        
        .recipe-thumb {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }
        
        .recipe-info h6 {
            margin: 0 0 5px 0;
            color: white;
            font-size: 1rem;
        }
        
        .recipe-info span {
            color: #888;
            font-size: 0.85rem;
        }
        
        .footer-modern .opening-hours {
            background: rgba(255,255,255,0.05);
            border-radius: 10px;
            padding: 20px;
        }
        
        .hours-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .hours-row:last-child {
            border-bottom: none;
        }
        
        .hours-day {
            color: #ccc;
        }
        
        .hours-time {
            color: var(--accent-color);
            font-weight: 500;
        }
        
        /* Footer Style 3 - Elegant with Image Background */
        .footer-elegant {
            background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.9)), url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 400"><rect fill="%232c3e50" width="1200" height="400"/><circle fill="%23ff6b35" cx="100" cy="100" r="30" opacity="0.3"/><circle fill="%23f39c12" cx="300" cy="200" r="20" opacity="0.4"/><circle fill="%23e74c3c" cx="500" cy="150" r="25" opacity="0.3"/><circle fill="%23f1c40f" cx="700" cy="300" r="35" opacity="0.2"/><circle fill="%23ff6b35" cx="900" cy="80" r="28" opacity="0.4"/><circle fill="%23f39c12" cx="1100" cy="250" r="22" opacity="0.3"/></svg>');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 80px 0 0;
            position: relative;
        }
        
        .footer-elegant .section-header {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .footer-elegant .section-header h3 {
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 15px;
            color: var(--accent-color);
        }
        
        .footer-elegant .section-header p {
            font-size: 1.1rem;
            color: #ddd;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .footer-elegant .feature-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 15px;
            padding: 30px 25px;
            text-align: center;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }
        
        .footer-elegant .feature-card:hover {
            background: rgba(255,255,255,0.15);
            transform: translateY(-5px);
        }
        
        .footer-elegant .feature-icon {
            font-size: 2.5rem;
            color: var(--accent-color);
            margin-bottom: 20px;
        }
        
        .footer-elegant .feature-card h5 {
            color: white;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .footer-elegant .feature-card p {
            color: #ddd;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-classic .footer-brand {
                font-size: 1.5rem;
                text-align: center;
            }
            
            .social-icons {
                justify-content: center;
            }
            
            .footer-bottom-links {
                flex-direction: column;
                gap: 10px;
            }
            
            .newsletter-form {
                text-align: center;
            }
            
            .footer-elegant .section-header h3 {
                font-size: 2rem;
            }
            
            .contact-info {
                text-align: center;
            }
        }
        
        @media (max-width: 576px) {
            .footer-classic, .footer-modern, .footer-elegant {
                padding: 40px 0 0;
            }
            
            .newsletter-form .input-group {
                flex-direction: column;
            }
            
            .newsletter-form .form-control,
            .newsletter-form .btn {
                border-radius: 25px;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>


    <!-- Footer Style 1: Classic Restaurant Footer -->
    <!--<footer class="footer-classic">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand">
                        <i class="fas fa-utensils"></i>
                        Delicious Bites
                    </div>
                    <p class="footer-description">
                        Experience the finest culinary journey with our handcrafted recipes, fresh ingredients, and passionate cooking. Join our community of food lovers and discover the art of exceptional dining.
                    </p>
                    <div class="social-icons">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" aria-label="Pinterest"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Explore</h5>
                    <ul class="footer-links">
                        <li><a href="home.php"><i class="fas fa-chevron-right"></i>Home</a></li>
                        <li><a href="menu.php"><i class="fas fa-chevron-right"></i>Menu</a></li>
                        <li><a href="about.php"><i class="fas fa-chevron-right"></i>About Us</a></li>
                        <li><a href="blog.php"><i class="fas fa-chevron-right"></i>Blog</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i>Contact</a></li>
                        
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Recipe Categories</h5>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-seedling"></i>Vegetarian</a></li>
                        <li><a href="#"><i class="fas fa-birthday-cake"></i>Desserts</a></li>
                        <li><a href="#"><i class="fas fa-clock"></i>Quick Meals</a></li>
                        <li><a href="#"><i class="fas fa-heart"></i>Healthy Options</a></li>
                        <li><a href="#"><i class="fas fa-globe"></i>International</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contact Info</h5>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i>123 Culinary Street, Food City, FC 12345</li>
                        <li><i class="fas fa-phone"></i>+1 (555) 123-4567</li>
                        <li><i class="fas fa-envelope"></i>hello@deliciousbites.com</li>
                        <li><i class="fas fa-clock"></i>Mon-Sat: 9AM-9PM</li>
                    </ul>
                    
                    <div class="newsletter-form">
                        <h6><i class="fas fa-envelope-open-text me-2"></i>Stay Updated</h6>
                        <p style="color: #ddd; font-size: 0.9rem; margin-bottom: 15px;">Get the latest recipes and cooking tips!</p>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-2">&copy; 2025 Delicious Bites. All rights reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-bottom-links">
                            <a href="#">Privacy Policy</a>
                            <a href="#">Terms of Service</a>
                            <a href="#">Cookie Policy</a>
                            <a href="#">Sitemap</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer> -->

    <!-- Footer Style 2: Modern Minimalist -->
   <!--<footer class="footer-modern">
        <div class="container">
            <div class="section-divider"></div>
            
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4 class="widget-title">Featured Recipes</h4>
                        <div class="recipe-preview">
                            <div class="recipe-thumb">
                                <i class="fas fa-pizza-slice"></i>
                            </div>
                            <div class="recipe-info">
                                <h6>Margherita Pizza</h6>
                                <span>5 ingredients • 25 mins</span>
                            </div>
                        </div>
                        <div class="recipe-preview">
                            <div class="recipe-thumb">
                                <i class="fas fa-hamburger"></i>
                            </div>
                            <div class="recipe-info">
                                <h6>Gourmet Burger</h6>
                                <span>8 ingredients • 20 mins</span>
                            </div>
                        </div>
                        <div class="recipe-preview">
                            <div class="recipe-thumb">
                                <i class="fas fa-ice-cream"></i>
                            </div>
                            <div class="recipe-info">
                                <h6>Milkshakes</h6>
                                <span>4 ingredients • 45 mins</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4 class="widget-title">Quick Links</h4>
                        <ul class="footer-links">
                            <li><a href="#">Recipe Collections</a></li>
                            <li><a href="#">Meal Planning</a></li>
                            <li><a href="#">Cooking Tips</a></li>
                            <li><a href="#">Ingredient Guide</a></li>
                            <li><a href="#">Kitchen Tools</a></li>
                            <li><a href="#">Nutrition Facts</a></li>
                            <li><a href="#">Chef Interviews</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4 class="widget-title">Opening Hours</h4>
                        <div class="opening-hours">
                            <div class="hours-row">
                                <span class="hours-day">Monday</span>
                                <span class="hours-time">9:00 - 22:00</span>
                            </div>
                            <div class="hours-row">
                                <span class="hours-day">Tuesday</span>
                                <span class="hours-time">9:00 - 22:00</span>
                            </div>
                            <div class="hours-row">
                                <span class="hours-day">Wednesday</span>
                                <span class="hours-time">9:00 - 22:00</span>
                            </div>
                            <div class="hours-row">
                                <span class="hours-day">Thursday</span>
                                <span class="hours-time">9:00 - 22:00</span>
                            </div>
                            <div class="hours-row">
                                <span class="hours-day">Friday</span>
                                <span class="hours-time">9:00 - 23:00</span>
                            </div>
                            <div class="hours-row">
                                <span class="hours-day">Saturday</span>
                                <span class="hours-time">10:00 - 23:00</span>
                            </div>
                            <div class="hours-row">
                                <span class="hours-day">Sunday</span>
                                <span class="hours-time">10:00 - 21:00</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4 class="widget-title">Connect With Us</h4>
                        <p style="color: #888; margin-bottom: 20px;">Follow us for daily recipes, cooking tips, and culinary inspiration!</p>
                        
                        <div class="social-icons mb-4">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                        
                        <div class="newsletter-form">
                            <h6>Newsletter Subscription</h6>
                            <p style="color: #888; font-size: 0.9rem;">Weekly recipes delivered to your inbox</p>
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Your email address">
                                <button class="btn btn-primary" type="button">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; 2025 Modern Kitchen. Crafted with <i class="fas fa-heart" style="color: var(--primary-color);"></i> for food lovers.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-bottom-links">
                            <a href="#">Privacy</a>
                            <a href="#">Terms</a>
                            <a href="#">Support</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer> -->

    <!-- Footer Style 3: Elegant with Features -->
    <footer class="footer-elegant">
        <div class="container">
            <div class="section-header">
                <h3>Culinary Excellence</h3>
                <p>Discover the art of cooking with our premium recipes, expert guidance, and passionate community of food enthusiasts.</p>
            </div>
            
            <div class="row mb-5">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h5>Award Winning</h5>
                        <p>Our recipes have won multiple culinary awards and are trusted by professional chefs worldwide.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5>Community Driven</h5>
                        <p>Join over 100,000 home cooks sharing recipes, tips, and culinary experiences in our vibrant community.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h5>Fresh & Organic</h5>
                        <p>We promote sustainable cooking with fresh, organic ingredients sourced from local farmers and suppliers.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h5>Mobile Friendly</h5>
                        <p>Access our recipes anywhere with our responsive design and mobile app for cooking on the go.</p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>About Culinary Excellence</h5>
                    <p style="color: #ddd; line-height: 1.6;">
                        We believe that great food brings people together. Our mission is to make exceptional cooking accessible to everyone through detailed recipes, expert tips, and a supportive community.
                    </p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>Menu Categories</h5>
                    <div class="row">
                        <div class="col-6">
                            <ul class="footer-links">
                                <li><a href="#">Cheesy Pizza</a></li>
                                <li><a href="#">Special Burger</a></li>
                                <li><a href="#">Hot Sapndwiches</a></li>
                                <li><a href="#">Cruncy Tacos</a></li>
                                <li><a href="#">Special Milkshakes</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="footer-links">
                                <li><a href="#">Vegetarian</a></li>
                                <li><a href="#">Gluten-Free</a></li>
                                <li><a href="#">Quick Meals</a></li>
                                <li><a href="#">International</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-12 mb-4">
                    <h5>Get In Touch</h5>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i>456 Gourmet Avenue, Foodie District, FD 67890</li>
                        <li><i class="fas fa-phone"></i>+1 (555) 987-6543</li>
                        <li><i class="fas fa-envelope"></i>info@culinaryexcellence.com</li>
                    </ul>
                    
                    <div class="newsletter-form mt-4">
                        <h6><i class="fas fa-paper-plane me-2"></i>Stay Connected</h6>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter email for updates">
                            <button class="btn btn-primary" type="button">Join</button>
                        </div> 