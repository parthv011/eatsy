<?php 
require('header.php');
require_once '../includes/db.php';

// Fetch all categories
$categories = [];
$cat_result = $conn->query("SELECT * FROM categories ORDER BY name");
while ($row = $cat_result->fetch_assoc()) {
    $categories[] = $row;
}

// Get selected category (default to 'all')
$selected_category = isset($_GET['category']) ? $_GET['category'] : 'all';

// Fetch menu items based on selected category
if ($selected_category === 'all') {
    $menu_query = "SELECT mi.*, c.name as category_name FROM menu_items mi 
                JOIN categories c ON mi.category_id = c.id 
                ORDER BY c.name, mi.name";
} else {
    $menu_query = "SELECT mi.*, c.name as category_name FROM menu_items mi 
                JOIN categories c ON mi.category_id = c.id 
                WHERE c.id = ? 
                ORDER BY mi.name";
}

$menu_items = [];
if ($selected_category === 'all') {
    $menu_result = $conn->query($menu_query);
} else {
    $stmt = $conn->prepare($menu_query);
    $stmt->bind_param("i", $selected_category);
    $stmt->execute();
    $menu_result = $stmt->get_result();
}

while ($row = $menu_result->fetch_assoc()) {
    $menu_items[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Food Delivery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            background-color: #f7ece3ff;
        }

        .category-btn {
            color: #BA8C63 !important;
            border-color: #BA8C63;
            transition: all 0.3s ease;
            margin: 2px;
        }

        .category-btn:hover, .category-btn.active {
            background-color: #BA8C63 !important;
            color: white !important;
            border-color: #BA8C63;
        }

        .menu-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .add-to-cart-btn {
            background-color: #BA8C63;
            border-color: #BA8C63;
            color: white;
            transition: all 0.3s ease;
        }

        .add-to-cart-btn:hover {
            background-color: #a67c56;
            border-color: #a67c56;
            transform: scale(1.05);
        }

        .price-tag {
            color: #BA8C63;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .category-section {
            margin: 2rem 0;
        }

        .menu-item-image {
            height: 200px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
            width: 100%;
        }

        .quantity-controls {
            display: none;
        }

        .quantity-controls.show {
            display: flex;
        }

        .quantity-btn {
            background-color: #BA8C63;
            border: none;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .quantity-display {
            background-color: #f8f9fa;
            border: 2px solid #BA8C63;
            min-width: 50px;
            text-align: center;
            font-weight: bold;
            color: #BA8C63;
        }

        .cart-summary {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #BA8C63;
            color: white;
            padding: 15px 20px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            cursor: pointer;
            z-index: 1000;
            display: none;
        }

        .cart-summary.show {
            display: block;
        }

        .no-image-placeholder {
            height: 200px;
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px 8px 0 0;
        }
    </style>
</head>

<body>
    <!-- Header Image -->
    <div style="z-index: 50; transform: translateY(0%); width: 100%;">
        <img src="../includes/uploads/bg-2.jpg" class="img-fluid mainimg" alt="Menu Background">
    </div>

    <!-- Menu Title -->
    <h2 class="mt-4 pt-4 text-center mb-4 fw-bold h-font">OUR MENU</h2>

    <div class="container">
        <!-- Category Filter Buttons -->
        <div class="row justify-content-center mb-4">
            <div class="col-12 text-center">
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    <!-- All Categories Button -->
                    <a href="menu.php?category=all" 
                        class="btn category-btn <?= $selected_category == 'all' ? 'active' : '' ?>">
                        All Categories
                    </a>
                    
                    <?php foreach ($categories as $category): ?>
                        <a href="menu.php?category=<?= $category['id'] ?>" 
                            class="btn category-btn <?= $selected_category == $category['id'] ? 'active' : '' ?>">
                            <?= htmlspecialchars($category['name']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Menu Items -->
        <?php if (empty($menu_items)): ?>
            <div class="row">
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <h4>No menu items found</h4>
                        <p>Please check back later or contact us for more information.</p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($menu_items as $item): ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card menu-card h-100">
                            <?php 
                            $image_exists = false;
                            $image_path = '';
                            
                            if ($item['image']) {
                                // Try different possible paths
                                $possible_paths = [
                                    '../' . $item['image'],
                                    $item['image'],
                                    '../includes/uploads/' . $item['image']
                                ];
                                
                                foreach ($possible_paths as $path) {
                                    if (file_exists($path)) {
                                        $image_exists = true;
                                        $image_path = str_replace('../', '', $path);
                                        break;
                                    }
                                }
                            }
                            ?>
                            
                            <?php if ($image_exists): ?>
                                <img src="../<?= htmlspecialchars($image_path) ?>" 
                                    class="menu-item-image" 
                                    alt="<?= htmlspecialchars($item['name']) ?>"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="no-image-placeholder" style="display: none;">
                                    <div class="text-center">
                                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                        <p class="text-muted mt-2">Image not available</p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="no-image-placeholder">
                                    <div class="text-center">
                                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                        <p class="text-muted mt-2">Image not available</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <div class="card-body d-flex flex-column">
                                <div class="mb-2">
                                    <span class="badge bg-secondary"><?= htmlspecialchars($item['category_name']) ?></span>
                                </div>
                                
                                <h5 class="card-title"><?= htmlspecialchars($item['name']) ?></h5>
                                
                                <?php if (!empty($item['description'])): ?>
                                    <p class="card-text text-muted flex-grow-1">
                                        <?= htmlspecialchars($item['description']) ?>
                                    </p>
                                <?php endif; ?>
                                
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="price-tag">₹<?= number_format($item['price'], 2) ?></span>
                                    
                                    <div class="cart-controls">
                                        <!-- Add to Cart Button -->
                                        <button class="btn add-to-cart-btn btn-sm add-item-btn" 
                                                data-id="<?= $item['id'] ?>"
                                                data-name="<?= htmlspecialchars($item['name']) ?>"
                                                data-price="<?= $item['price'] ?>">
                                            <i class="bi bi-cart-plus"></i> Add to Cart
                                        </button>
                                        
                                        <!-- Quantity Controls (Hidden by default) -->
                                        <div class="quantity-controls align-items-center gap-2" id="qty-<?= $item['id'] ?>">
                                            <button class="quantity-btn decrease-btn" data-id="<?= $item['id'] ?>">
                                                <i class="bi bi-dash"></i>
                                            </button>
                                            <input type="text" class="form-control quantity-display" value="1" readonly id="quantity-<?= $item['id'] ?>">
                                            <button class="quantity-btn increase-btn" data-id="<?= $item['id'] ?>">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Cart Summary (Fixed Position) -->
    <div class="cart-summary" id="cartSummary">
        <i class="bi bi-cart3"></i>
        <span id="cartCount">0</span> items | ₹<span id="cartTotal">0.00</span>
    </div>

    <!-- Footer -->
    <footer class="py-5 mt-5" style="background-color: #ffffff;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                    <h2 class="display-5 fw-bold mb-3 text-dark">Taste the convenience.</h2>
                    <p class="lead mb-4 text-secondary">
                        A leading platform in India that evolved from restaurant reviews to a comprehensive food delivery service, 
                        offering user-generated reviews and ratings.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <img src="../includes/uploads/dboy.jpg" class="img-fluid rounded" alt="Food Delivery">
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Cart functionality (same as before)
        let cart = JSON.parse(localStorage.getItem('cart')) || {};
        
        function updateCartDisplay() {
            let totalItems = 0;
            let totalPrice = 0;
            
            for (let id in cart) {
                totalItems += cart[id].quantity;
                totalPrice += cart[id].quantity * cart[id].price;
            }
            
            document.getElementById('cartCount').textContent = totalItems;
            document.getElementById('cartTotal').textContent = totalPrice.toFixed(2);
            
            const cartSummary = document.getElementById('cartSummary');
            if (totalItems > 0) {
                cartSummary.classList.add('show');
            } else {
                cartSummary.classList.remove('show');
            }
            
            for (let id in cart) {
                const addBtn = document.querySelector(`[data-id="${id}"].add-item-btn`);
                const qtyControls = document.getElementById(`qty-${id}`);
                const qtyDisplay = document.getElementById(`quantity-${id}`);
                
                if (cart[id].quantity > 0) {
                    if (addBtn) addBtn.style.display = 'none';
                    if (qtyControls) qtyControls.classList.add('show');
                    if (qtyDisplay) qtyDisplay.value = cart[id].quantity;
                } else {
                    if (addBtn) addBtn.style.display = 'inline-block';
                    if (qtyControls) qtyControls.classList.remove('show');
                }
            }
        }
        
        document.querySelectorAll('.add-item-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const price = parseFloat(this.dataset.price);
                
                if (!cart[id]) {
                    cart[id] = { name: name, price: price, quantity: 0 };
                }
                
                cart[id].quantity++;
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartDisplay();
            });
        });
        
        document.querySelectorAll('.increase-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                if (cart[id]) {
                    cart[id].quantity++;
                    localStorage.setItem('cart', JSON.stringify(cart));
                    updateCartDisplay();
                }
            });
        });
        
        document.querySelectorAll('.decrease-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                if (cart[id] && cart[id].quantity > 0) {
                    cart[id].quantity--;
                    if (cart[id].quantity === 0) {
                        delete cart[id];
                    }
                    localStorage.setItem('cart', JSON.stringify(cart));
                    updateCartDisplay();
                }
            });
        });
        
        document.getElementById('cartSummary').addEventListener('click', function() {
            window.location.href = 'cart.php';
        });
        
        updateCartDisplay();
    </script>

    <?php require('footer.php') ?>
</body>
</html>