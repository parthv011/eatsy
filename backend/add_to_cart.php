<?php
session_start();

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Product data - you can move this to a database later
$products = [
    // Pizzas
    'pizza_margherita' => [
        'name' => 'Margherita Pizza',
        'price' => 300.00,
        'image' => '../includes/images/mpizza1.jpg',
        'description' => 'Classic pizza with tomato sauce, mozzarella and fresh basil',
        'category' => 'pizza'
    ],
    'pizza_paneer_capsicum' => [
        'name' => 'Paneer Capsicum Pizza',
        'price' => 400.00,
        'image' => '../includes/images/mpizza2.jpg',
        'description' => 'Spiced paneer with capsicum and onions',
        'category' => 'pizza'
    ],
    'pizza_mexican_green' => [
        'name' => 'Mexican Green Wave Pizza',
        'price' => 450.00,
        'image' => '../includes/images/mpizza3.jpg',
        'description' => 'Onions, capsicum, tomatoes, jalapenos with Mexican herbs',
        'category' => 'pizza'
    ],
    'pizza_cheese_corn' => [
        'name' => 'Cheese & Corn Pizza',
        'price' => 360.00,
        'image' => '../includes/images/mpizza4.png',
        'description' => 'Simple combination of cheese and golden corn',
        'category' => 'pizza'
    ],
    'pizza_pesto' => [
        'name' => 'Pesto Pizza',
        'price' => 420.00,
        'image' => '../includes/images/mpizza5.jpg',
        'description' => 'Pesto base with roasted vegetables',
        'category' => 'pizza'
    ],
    'pizza_peppy_paneer' => [
        'name' => 'Peppy Paneer Pizza',
        'price' => 530.00,
        'image' => '../includes/images/mpizza6.jpg',
        'description' => 'Chunky paneer with capsicum and spicy red pepper',
        'category' => 'pizza'
    ],
    
    // Burgers
    'burger_aloo_tikki' => [
        'name' => 'Aloo Tikki Burger',
        'price' => 150.00,
        'image' => '../includes/images/mbg1.jpg',
        'description' => 'Spiced potato patty with onions, tomatoes and chutney',
        'category' => 'burger'
    ],
    'burger_paneer' => [
        'name' => 'Cheeze Paneer Burger',
        'price' => 200.00,
        'image' => '../includes/images/mbg2.jpg',
        'description' => 'Grilled paneer patty with cheese',
        'category' => 'burger'
    ],
    'burger_mix_veg' => [
        'name' => 'Mix Vegetable Burger',
        'price' => 180.00,
        'image' => '../includes/images/mbg3.jpg',
        'description' => 'Mixed vegetables with Indian spices',
        'category' => 'burger'
    ],
    'burger_black_bean' => [
        'name' => 'Black Bean Burger',
        'price' => 270.00,
        'image' => '../includes/images/mbg4.jpg',
        'description' => 'Black bean patty with spicy mayo',
        'category' => 'burger'
    ],
    'burger_tofu' => [
        'name' => 'Tofu Burger',
        'price' => 300.00,
        'image' => '../includes/images/mbg5.jpg',
        'description' => 'Vegan-friendly tofu patty',
        'category' => 'burger'
    ],
    'burger_lentil' => [
        'name' => 'Lentil Burger',
        'price' => 330.00,
        'image' => '../includes/images/mbg6.jpg',
        'description' => 'Spiced lentil patty with Indian masalas',
        'category' => 'burger'
    ],
    
    // Sandwiches
    'sandwich_aloo_masala' => [
        'name' => 'Aloo Masala Sandwich',
        'price' => 120.00,
        'image' => '../includes/images/ms1.jpg',
        'description' => 'Spicy mashed potato with Indian spices',
        'category' => 'sandwich'
    ],
    'sandwich_paneer_tikka' => [
        'name' => 'Paneer Tikka Sandwich',
        'price' => 200.00,
        'image' => '../includes/images/ms2.jpg',
        'description' => 'Marinated grilled paneer with vegetables',
        'category' => 'sandwich'
    ],
    'sandwich_veg_grilled' => [
        'name' => 'Vegetable Grilled Sandwich',
        'price' => 150.00,
        'image' => '../includes/images/vgs.jpeg',
        'description' => 'Fresh vegetables with cheese, grilled to perfection',
        'category' => 'sandwich'
    ],
    'sandwich_veg_cheese' => [
        'name' => 'Vegetable Cheese Sandwich',
        'price' => 180.00,
        'image' => '../includes/images/ms4.jpg',
        'description' => 'Vegetables with melted cheese',
        'category' => 'sandwich'
    ],
    'sandwich_curd' => [
        'name' => 'Curd Sandwich',
        'price' => 140.00,
        'image' => '../includes/images/ms5.jpg',
        'description' => 'Hung curd with fresh vegetables',
        'category' => 'sandwich'
    ],
    
    // Tacos
    'tacos_paneer' => [
        'name' => 'Paneer Tacos',
        'price' => 300.00,
        'image' => '../includes/images/mt1.jpg',
        'description' => 'Paneer and cheese with sauce',
        'category' => 'tacos'
    ],
    'tacos_vegetable' => [
        'name' => 'Vegetable Tacos',
        'price' => 240.00,
        'image' => '../includes/images/mt2.jpg',
        'description' => 'Spiced vegetables with tandoori sauce',
        'category' => 'tacos'
    ],
    'tacos_black_bean' => [
        'name' => 'Black Bean Tacos',
        'price' => 450.00,
        'image' => '../includes/images/mt3.jpg',
        'description' => 'Black beans with Mexican herbs and cheese',
        'category' => 'tacos'
    ],
    'tacos_garlic_butter' => [
        'name' => 'Garlic Butter Tacos',
        'price' => 360.00,
        'image' => '../includes/images/mt4.jpg',
        'description' => 'Cheese and garlic with butter',
        'category' => 'tacos'
    ],
    
    // Sliders
    'slider_fluffy_bread' => [
        'name' => 'Fluffy Bread With Crispy Crust',
        'price' => 210.00,
        'image' => '../includes/images/gb1.jpg',
        'description' => 'White sauce, mozzarella and fresh basil',
        'category' => 'slider'
    ],
    'slider_double_cheese' => [
        'name' => 'Double Cheese Bread',
        'price' => 190.00,
        'image' => '../includes/images/gb2.jpg',
        'description' => 'Spiced garlic with mozzarella cheese',
        'category' => 'slider'
    ],
    'slider_margherita' => [
        'name' => 'Margherita Cheese Bread',
        'price' => 250.00,
        'image' => '../includes/images/gb3.jpg',
        'description' => 'Onions, capsicum, tomatoes with Mexican herbs',
        'category' => 'slider'
    ],
    'slider_crunchy' => [
        'name' => 'Crunchy Slices',
        'price' => 160.00,
        'image' => '../includes/images/gb4.jpg',
        'description' => 'Simple cheese with garlic and white sauce',
        'category' => 'slider'
    ],
    
    // Drinks
    'drink_chocolate_shake' => [
        'name' => 'Chocolate Milkshake',
        'price' => 280.00,
        'image' => '../includes/images/md1.jpg',
        'description' => 'Smooth chocolate milkshake with ice cream',
        'category' => 'drink'
    ],
    'drink_mango_shake' => [
        'name' => 'Mango Milkshake',
        'price' => 260.00,
        'image' => '../includes/images/md2.jpg',
        'description' => 'Sweet mango shake with cardamom',
        'category' => 'drink'
    ],
    'drink_strawberry_shake' => [
        'name' => 'Strawberry Milkshake',
        'price' => 230.00,
        'image' => '../includes/images/md3.jpg',
        'description' => 'Fresh strawberry milkshake',
        'category' => 'drink'
    ],
    'drink_vanilla_shake' => [
        'name' => 'Vanilla Milkshake',
        'price' => 150.00,
        'image' => '../includes/images/md4.jpg',
        'description' => 'Classic vanilla milkshake',
        'category' => 'drink'
    ],
    'drink_coffee_shake' => [
        'name' => 'Milky Coffee',
        'price' => 260.00,
        'image' => '../includes/images/md5.jpg',
        'description' => 'Coffee milkshake with mocha variation',
        'category' => 'drink'
    ]
];

// Handle add to cart
if ($_GET['item'] ?? false) {
    $item_id = $_GET['item'];
    
    if (isset($products[$item_id])) {
        $product = $products[$item_id];
        
        // If item already in cart, increase quantity
        if (isset($_SESSION['cart'][$item_id])) {
            $_SESSION['cart'][$item_id]['quantity']++;
        } else {
            // Add new item to cart
            $_SESSION['cart'][$item_id] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'description' => $product['description'],
                'quantity' => 1
            ];
        }
        
        // Set success message
        $_SESSION['cart_message'] = $product['name'] . ' added to cart!';
    } else {
        $_SESSION['cart_error'] = 'Product not found!';
    }
}

// Redirect back to referring page or cart
$redirect_url = $_SERVER['HTTP_REFERER'] ?? '../frontend/cart.php';
header('Location: ' . $redirect_url);
exit;
?>