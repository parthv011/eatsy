<?php
session_start();
header('Content-Type: application/json');
require_once 'includes/db.php';

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to send JSON response
function sendResponse($success, $message, $data = null) {
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, 'Invalid request method');
}

// Get the action from POST data
$action = $_POST['action'] ?? '';

// Initialize cart in session if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

switch ($action) {
    case 'add':
        addToCart();
        break;
    case 'update':
        updateCart();
        break;
    case 'remove':
        removeFromCart();
        break;
    case 'get':
        getCart();
        break;
    case 'clear':
        clearCart();
        break;
    case 'apply_coupon':
        applyCoupon();
        break;
    case 'sync_to_db':
        syncCartToDatabase();
        break;
    case 'load_from_db':
        loadCartFromDatabase();
        break;
    case 'validate':
        validateCartItems();
        break;
    default:
        sendResponse(false, 'Invalid action');
}

// Add item to cart
function addToCart() {
    global $conn;
    
    $item_id = intval($_POST['item_id'] ?? 0);
    $quantity = intval($_POST['quantity'] ?? 1);
    
    if ($item_id <= 0 || $quantity <= 0) {
        sendResponse(false, 'Invalid item ID or quantity');
    }
    
    // Fetch item details from database using your exact table structure
    $stmt = $conn->prepare("
        SELECT mi.id, mi.name, mi.description, mi.price, mi.image, c.name as category_name 
        FROM menu_items mi 
        LEFT JOIN categories c ON mi.category_id = c.id 
        WHERE mi.id = ?
    ");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        sendResponse(false, 'Item not found');
    }
    
    $item = $result->fetch_assoc();
    $stmt->close();
    
    // Add to session cart or update quantity if already exists
    if (isset($_SESSION['cart'][$item_id])) {
        $_SESSION['cart'][$item_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$item_id] = [
            'id' => $item['id'],
            'name' => $item['name'],
            'description' => $item['description'],
            'price' => floatval($item['price']),
            'image' => $item['image'],
            'category_name' => $item['category_name'],
            'quantity' => $quantity,
            'added_at' => date('Y-m-d H:i:s')
        ];
    }
    
    // If user is logged in, also update database cart
    if (isset($_SESSION['user_id'])) {
        updateDatabaseCart($item_id, $_SESSION['cart'][$item_id]['quantity']);
    }
    
    $cartSummary = getCartSummary();
    sendResponse(true, 'Item added to cart successfully', [
        'cart_count' => $cartSummary['total_items'],
        'cart_total' => $cartSummary['subtotal'],
        'item' => $_SESSION['cart'][$item_id]
    ]);
}

// Update cart item quantity
function updateCart() {
    $item_id = intval($_POST['item_id'] ?? 0);
    $quantity = intval($_POST['quantity'] ?? 0);
    
    if ($item_id <= 0) {
        sendResponse(false, 'Invalid item ID');
    }
    
    if (!isset($_SESSION['cart'][$item_id])) {
        sendResponse(false, 'Item not found in cart');
    }
    
    if ($quantity <= 0) {
        // Remove item if quantity is 0 or negative
        unset($_SESSION['cart'][$item_id]);
        
        // Remove from database cart if user is logged in
        if (isset($_SESSION['user_id'])) {
            removeDatabaseCartItem($item_id);
        }
        
        $message = 'Item removed from cart';
    } else {
        // Update quantity
        $_SESSION['cart'][$item_id]['quantity'] = $quantity;
        
        // Update database cart if user is logged in
        if (isset($_SESSION['user_id'])) {
            updateDatabaseCart($item_id, $quantity);
        }
        
        $message = 'Cart updated successfully';
    }
    
    $cartSummary = getCartSummary();
    sendResponse(true, $message, [
        'cart_count' => $cartSummary['total_items'],
        'cart_total' => $cartSummary['subtotal'],
        'item_total' => isset($_SESSION['cart'][$item_id]) ? 
            $_SESSION['cart'][$item_id]['price'] * $_SESSION['cart'][$item_id]['quantity'] : 0
    ]);
}

// Remove item from cart
function removeFromCart() {
    $item_id = intval($_POST['item_id'] ?? 0);
    
    if ($item_id <= 0) {
        sendResponse(false, 'Invalid item ID');
    }
    
    if (!isset($_SESSION['cart'][$item_id])) {
        sendResponse(false, 'Item not found in cart');
    }
    
    $item_name = $_SESSION['cart'][$item_id]['name'];
    unset($_SESSION['cart'][$item_id]);
    
    // Remove from database cart if user is logged in
    if (isset($_SESSION['user_id'])) {
        removeDatabaseCartItem($item_id);
    }
    
    $cartSummary = getCartSummary();
    sendResponse(true, "$item_name removed from cart", [
        'cart_count' => $cartSummary['total_items'],
        'cart_total' => $cartSummary['subtotal']
    ]);
}

// Get cart contents
function getCart() {
    $cartSummary = getCartSummary();
    sendResponse(true, 'Cart retrieved successfully', [
        'items' => $_SESSION['cart'],
        'summary' => $cartSummary
    ]);
}

// Clear entire cart
function clearCart() {
    $_SESSION['cart'] = [];
    if (isset($_SESSION['applied_coupon'])) {
        unset($_SESSION['applied_coupon']);
    }
    
    // Clear database cart if user is logged in
    if (isset($_SESSION['user_id'])) {
        clearDatabaseCart();
    }
    
    sendResponse(true, 'Cart cleared successfully', [
        'cart_count' => 0,
        'cart_total' => 0
    ]);
}

// Apply coupon code
function applyCoupon() {
    $coupon_code = strtoupper(trim($_POST['coupon_code'] ?? ''));
    
    if (empty($coupon_code)) {
        sendResponse(false, 'Please enter a coupon code');
    }
    
    // Define available coupons based on your offers
    $coupons = [
        'EAT50' => [
            'discount' => 50,
            'min_amount' => 299,
            'type' => 'fixed',
            'description' => 'Get Flat Discount of Rs.50 on Minimum Billing of Rs.299'
        ],
        'EAT75' => [
            'discount' => 75,
            'min_amount' => 399,
            'type' => 'fixed',
            'description' => 'Get Flat Discount of Rs.75 on Minimum Billing of Rs.399'
        ],
        'EAT100' => [
            'discount' => 100,
            'min_amount' => 599,
            'type' => 'fixed',
            'description' => 'Get Flat Discount of Rs.100 on Minimum Billing of Rs.599'
        ],
        'WELCOME10' => [
            'discount' => 10,
            'min_amount' => 200,
            'type' => 'percentage',
            'description' => '10% off on orders above Rs.200'
        ]
    ];
    
    if (!isset($coupons[$coupon_code])) {
        sendResponse(false, 'Invalid coupon code');
    }
    
    $coupon = $coupons[$coupon_code];
    $cartSummary = getCartSummary();
    
    if ($cartSummary['subtotal'] < $coupon['min_amount']) {
        sendResponse(false, "Minimum order amount of ₹{$coupon['min_amount']} required for this coupon");
    }
    
    // Calculate discount
    if ($coupon['type'] === 'fixed') {
        $discount = $coupon['discount'];
    } else { // percentage
        $discount = ($cartSummary['subtotal'] * $coupon['discount']) / 100;
    }
    
    // Store coupon in session
    $_SESSION['applied_coupon'] = [
        'code' => $coupon_code,
        'discount' => $discount,
        'type' => $coupon['type'],
        'description' => $coupon['description'],
        'applied_at' => date('Y-m-d H:i:s')
    ];
    
    $updatedSummary = getCartSummary();
    sendResponse(true, "Coupon $coupon_code applied successfully!", [
        'discount' => $discount,
        'summary' => $updatedSummary
    ]);
}

// Helper function to calculate cart summary
function getCartSummary() {
    $subtotal = 0;
    $total_items = 0;
    $delivery_fee = 40;
    $tax_rate = 0.05; // 5% GST
    
    // Calculate subtotal and item count
    foreach ($_SESSION['cart'] as $item) {
        $subtotal += $item['price'] * $item['quantity'];
        $total_items += $item['quantity'];
    }
    
    // Apply delivery fee only if cart is not empty
    $delivery_fee = $total_items > 0 ? $delivery_fee : 0;
    
    // Calculate discount
    $discount = 0;
    if (isset($_SESSION['applied_coupon'])) {
        $discount = $_SESSION['applied_coupon']['discount'];
    }
    
    // Calculate tax on (subtotal + delivery - discount)
    $taxable_amount = max(0, $subtotal + $delivery_fee - $discount);
    $tax = $taxable_amount * $tax_rate;
    
    // Final total
    $total = $subtotal + $delivery_fee + $tax - $discount;
    
    return [
        'subtotal' => round($subtotal, 2),
        'total_items' => $total_items,
        'delivery_fee' => round($delivery_fee, 2),
        'discount' => round($discount, 2),
        'tax' => round($tax, 2),
        'total' => round(max(0, $total), 2), // Ensure total is never negative
        'applied_coupon' => $_SESSION['applied_coupon'] ?? null
    ];
}

// Database cart functions for logged-in users
function updateDatabaseCart($item_id, $quantity) {
    global $conn;
    
    if (!isset($_SESSION['user_id'])) {
        return false;
    }
    
    $user_id = $_SESSION['user_id'];
    
    // Check if item already exists in database cart
    $stmt = $conn->prepare("SELECT id FROM cart WHERE user_id = ? AND item_id = ?");
    $stmt->bind_param("ii", $user_id, $item_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Update existing cart item
        $stmt->close();
        $stmt = $conn->prepare("UPDATE cart SET quantity = ?, added_at = NOW() WHERE user_id = ? AND item_id = ?");
        $stmt->bind_param("iii", $quantity, $user_id, $item_id);
    } else {
        // Insert new cart item
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO cart (user_id, item_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $user_id, $item_id, $quantity);
    }
    
    $success = $stmt->execute();
    $stmt->close();
    
    return $success;
}

function removeDatabaseCartItem($item_id) {
    global $conn;
    
    if (!isset($_SESSION['user_id'])) {
        return false;
    }
    
    $user_id = $_SESSION['user_id'];
    
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND item_id = ?");
    $stmt->bind_param("ii", $user_id, $item_id);
    $success = $stmt->execute();
    $stmt->close();
    
    return $success;
}

function clearDatabaseCart() {
    global $conn;
    
    if (!isset($_SESSION['user_id'])) {
        return false;
    }
    
    $user_id = $_SESSION['user_id'];
    
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $success = $stmt->execute();
    $stmt->close();
    
    return $success;
}

// Sync session cart to database (when user logs in)
function syncCartToDatabase() {
    global $conn;
    
    if (!isset($_SESSION['user_id']) || empty($_SESSION['cart'])) {
        sendResponse(false, 'No user logged in or cart is empty');
    }
    
    $user_id = $_SESSION['user_id'];
    $synced_items = 0;
    
    foreach ($_SESSION['cart'] as $item_id => $item) {
        if (updateDatabaseCart($item_id, $item['quantity'])) {
            $synced_items++;
        }
    }
    
    sendResponse(true, "Cart synced successfully. $synced_items items saved.", [
        'synced_items' => $synced_items
    ]);
}

// Load cart from database (when user logs in)
function loadCartFromDatabase() {
    global $conn;
    
    if (!isset($_SESSION['user_id'])) {
        sendResponse(false, 'No user logged in');
    }
    
    $user_id = $_SESSION['user_id'];
    
    $stmt = $conn->prepare("
        SELECT c.item_id, c.quantity, mi.name, mi.description, mi.price, mi.image, cat.name as category_name
        FROM cart c
        JOIN menu_items mi ON c.item_id = mi.id
        LEFT JOIN categories cat ON mi.category_id = cat.id
        WHERE c.user_id = ?
    ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $loaded_items = 0;
    
    while ($row = $result->fetch_assoc()) {
        $_SESSION['cart'][$row['item_id']] = [
            'id' => $row['item_id'],
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => floatval($row['price']),
            'image' => $row['image'],
            'category_name' => $row['category_name'],
            'quantity' => $row['quantity'],
            'added_at' => date('Y-m-d H:i:s')
        ];
        $loaded_items++;
    }
    
    $stmt->close();
    
    $cartSummary = getCartSummary();
    sendResponse(true, "Cart loaded successfully. $loaded_items items retrieved.", [
        'loaded_items' => $loaded_items,
        'cart' => $_SESSION['cart'],
        'summary' => $cartSummary
    ]);
}

// Validate cart items against current database prices and availability
function validateCartItems() {
    global $conn;
    
    if (empty($_SESSION['cart'])) {
        sendResponse(true, 'Cart is empty', ['valid' => true, 'issues' => []]);
    }
    
    $item_ids = array_keys($_SESSION['cart']);
    $placeholders = str_repeat('?,', count($item_ids) - 1) . '?';
    
    $stmt = $conn->prepare("
        SELECT mi.id, mi.name, mi.price, c.name as category_name 
        FROM menu_items mi 
        LEFT JOIN categories c ON mi.category_id = c.id 
        WHERE mi.id IN ($placeholders)
    ");
    $stmt->bind_param(str_repeat('i', count($item_ids)), ...$item_ids);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $db_items = [];
    while ($row = $result->fetch_assoc()) {
        $db_items[$row['id']] = $row;
    }
    $stmt->close();
    
    $issues = [];
    $valid = true;
    
    foreach ($_SESSION['cart'] as $item_id => $cart_item) {
        if (!isset($db_items[$item_id])) {
            $issues[] = "Item '{$cart_item['name']}' is no longer available";
            unset($_SESSION['cart'][$item_id]);
            if (isset($_SESSION['user_id'])) {
                removeDatabaseCartItem($item_id);
            }
            $valid = false;
        } elseif (abs($db_items[$item_id]['price'] - $cart_item['price']) > 0.01) {
            $old_price = $cart_item['price'];
            $new_price = floatval($db_items[$item_id]['price']);
            $issues[] = "Price for '{$cart_item['name']}' changed from ₹{$old_price} to ₹{$new_price}";
            $_SESSION['cart'][$item_id]['price'] = $new_price;
            $valid = false;
        }
    }
    
    $cartSummary = getCartSummary();
    sendResponse($valid, $valid ? 'Cart is valid' : 'Cart has been updated', [
        'valid' => $valid,
        'issues' => $issues,
        'summary' => $cartSummary
    ]);
}

// Get menu items that are frequently bought together
function getRecommendedItems() {
    global $conn;
    
    if (empty($_SESSION['cart'])) {
        return [];
    }
    
    // Get categories of items in cart
    $item_ids = array_keys($_SESSION['cart']);
    $placeholders = str_repeat('?,', count($item_ids) - 1) . '?';
    
    $stmt = $conn->prepare("
        SELECT DISTINCT category_id 
        FROM menu_items 
        WHERE id IN ($placeholders) AND category_id IS NOT NULL
    ");
    $stmt->bind_param(str_repeat('i', count($item_ids)), ...$item_ids);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['category_id'];
    }
    $stmt->close();
    
    if (empty($categories)) {
        return [];
    }
    
    // Get recommended items from same categories (excluding items already in cart)
    $cat_placeholders = str_repeat('?,', count($categories) - 1) . '?';
    $item_placeholders = str_repeat('?,', count($item_ids) - 1) . '?';
    
    $stmt = $conn->prepare("
        SELECT mi.id, mi.name, mi.price, mi.image, c.name as category_name
        FROM menu_items mi 
        LEFT JOIN categories c ON mi.category_id = c.id
        WHERE mi.category_id IN ($cat_placeholders) 
        AND mi.id NOT IN ($item_placeholders)
        ORDER BY RAND() 
        LIMIT 4
    ");
    
    $params = array_merge($categories, $item_ids);
    $types = str_repeat('i', count($params));
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $recommended = [];
    while ($row = $result->fetch_assoc()) {
        $recommended[] = $row;
    }
    $stmt->close();
    
    return $recommended;
}
?>