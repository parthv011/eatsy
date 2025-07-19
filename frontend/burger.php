<?php require('../includes/header.php') ?>
<script>
    function renderCart() {
    const cart = JSON.parse(localStorage.getItem('cart')) || {};
    const cartContainer = document.getElementById('cart-items');
    cartContainer.innerHTML = ''; // clear current content

    for (let id in cart) {
        const item = cart[id];
        const itemHTML = `
            <div class="cart-item" data-item-id="${id}">
                <div class="row align-items-center">
                    <div class="col-md-2 col-3">
                        <img src="${item.image}" alt="${item.name}" class="item-image">
                    </div>
                    <div class="col-md-5 col-9">
                        <div class="item-details">
                            <h6>${item.name}</h6>
                            <p class="item-description">Delicious item</p>
                            <div class="item-options">
                                ${item.options?.map(opt => `<span class="option-badge">${opt}</span>`).join('') || ''}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 text-center">
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="updateQuantity(${id}, -1)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="quantity-display" id="qty-${id}">${item.quantity}</span>
                            <button class="quantity-btn" onclick="updateQuantity(${id}, 1)">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-2 col-4 text-end">
                        <div class="item-price">₹<span id="price-${id}">${(item.price * item.quantity).toFixed(2)}</span></div>
                        <small class="text-muted">₹${item.price} each</small>
                    </div>
                    <div class="col-md-1 col-2 text-end">
                        <button class="remove-btn" onclick="removeItem(${id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        cartContainer.insertAdjacentHTML('beforeend', itemHTML);
    }

    updateSummary();
    updateCartBadge();

    if (Object.keys(cart).length === 0) {
        showEmptyCart();
    }
}

</script>
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
                    <img src="../includes/images/mbg1.jpg" class="img-fluid product-image" alt="Aloo Tikki Burger">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Aloo Tikki Burger</h1>
                    <p class="lead">A classic Indian favorite featuring a spiced potato patty (aloo tikki), typically topped with onions, tomatoes, and chutney in a bun.</p>
                    <h2 class="mb-4">₹ 150.00</h2>
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
                    <img src="../includes/images/mbg2.jpg" class="img-fluid product-image" alt="Cheeze Paneer Burger">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Cheeze Paneer Burger</h1>
                    <p class="lead">A burger with a paneer (Indian cottage cheese) patty, often grilled or shallow fried, and spiced according to preference.</p>
                    <h2 class="mb-4">₹ 200.00</h2>
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
                    <img src="../includes/images/mbg3.jpg" class="img-fluid product-image" alt="Mix Vegetable Burger">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Mix Vegetable Burger</h1>
                    <p class="lead">A patty made from various steamed or sautéed vegetables like potatoes, carrots, peas, beans, and cauliflower, spiced with Indian masalas like garam masala and cumin.</p>
                    <h2 class="mb-4">₹ 180.00</h2>
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
                    <img src="../includes/images/mbg4.jpg" class="img-fluid product-image" alt="Beans Burger">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Black Bean Burger</h1>
                    <p class="lead">A popular Western import, often made with black beans and other ingredients, sometimes with an Indian twist like spicy mayo or avocado and mango.</p>
                    <h2 class="mb-4">₹ 270.00</h2>
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
                    <img src="../includes/images/mbg5.jpg" class="img-fluid product-image" alt="Tofu Burger">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Tofu Burger</h1>
                    <p class="lead">A vegan-friendly option, with a patty made from tofu, sometimes crumbled or grated, and used as a substitute for paneer or cheese.</p>
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
                    <img src="../includes/images/mbg6.jpg" class="img-fluid product-image" alt="Lentil Burger">
                </div>
                <div class="col-md-7 p-3 d-flex flex-column justify-content-center">
                    <h1 class="display-4 fw-bold">Lentil Burger</h1>
                    <p class="lead">Patties made from lentils, often spiced with Indian masalas, and served in a bun or wrapped in lettuce.</p>
                    <h2 class="mb-4">₹ 330.00</h2>
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