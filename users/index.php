<?php require('header.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index</title>

  <style>
    body {
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
      background-color: #f8f9fa; 
    }

    footer {
      background-color: #ffffff; 
    }

    .app-badge {
      max-width: 150px; 
      height: auto;
      transition: transform 0.2s ease-in-out; /* Smooth hover effect */
    }

    .app-badge:hover {
      transform: translateY(-3px); 
    }

    h2, p {
      color: #343a40; /* Dark grey text */
    }
  </style>

</head>
<style>
  body{
     background-color: #f7ece3ff;
  }
  .text-success{
     color: #BA8C63 !important;
  }
  .offer-btn{
     color: #BA8C63 !important;
     border-color: #BA8C63;
  }
  .offer-btn:hover{
    background-color: #BA8C63 !important ;
    color: white;
  }
  .card {
    position: relative;
    overflow: hidden;
  }
  .card:hover{
    transform: translateY(-5px); 
    box-shadow: 0 10px 20px rgba(0,0,0,0.15); 
    cursor: pointer; 
  }
  .percentage-icon {
    position: absolute;
    top: -20px;
    right: -20px;
    transform: rotate(15deg);
  }
</style>

<body>
  <div style="z-index: 50; transform: translateY(0%); width: 100%;">
    <img src="../includes/uploads/bg-2.jpg" class="img-fluid mainimg" alt="Oops!!!">

    <a href="menu.php"><h2 class="mt-0 pt-4 text-center mb-4 fw-bold h-font">MENU</h2></a>
    <div class="container">
      <div class="row mb-4">

        <div class="col-lg-3 col-lg-4 my-3 ">
          <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
            <img src="../includes/uploads/pizza.jpg" class="card-img-top">
          </div>
        </div>

        <div class="col-lg-3 col-lg-4 my-3 ">
          <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
           <img src="../includes/uploads/burger-2.jpg" class="card-img-top">
          </div>
        </div>

        <div class="col-lg-3 col-lg-4 my-3 ">
          <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
            <img src="../includes/uploads/sandwich-2.jpg" class="card-img-top">
          </div>
        </div>

        <div class="col-lg-3 col-lg-4 my-3 ">
          <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
            <img src="../includes/uploads/tacos.jpg" class="card-img-top">
          </div>
        </div>

        <div class="col-lg-3 col-lg-4 my-3 ">
          <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
            <img src="../includes/uploads/gb.jpg" class="card-img-top">
          </div>
        </div>

        <div class="col-lg-3 col-lg-4 my-3 ">
          <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
            <img src="../includes/uploads/shake.jpg" class="card-img-top">
          </div>
        </div>
      </div>

      <!-- offers -->
      <div class="container my-5">
    <h2 class="text-center mb-4">TOP OFFERS</h2>
    <div class="row justify-content-center">
        <div class="col-12 col-md-4 mb-4">
            <div class="card h-100 rounded" style="background-color: #f7f7f7;"> <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div>
                        <h3 class="card-title text-success fs-3">Rs.50 OFF</h3>
                        <p class="card-text text-dark fs-5">Get Flat Discount of Rs.50 on Minimum Billing of Rs.299</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button type="button" class="btn btn-outline-success rounded-pill px-4 py-2" style="border-color: #BA8C63; color: #BA8C63;">Use Code EAT50</button>
                        <div class="percentage-icon" style="width: 80px; height: 80px; background-color: #d4edda; border-radius: 50%; display: flex; justify-content: center; align-items: center; opacity: 0.7;">
                            <span class="text-success fs-2 fw-bold">%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-4">
            <div class="card h-100 rounded" style="background-color: #f7f7f7;"> <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div>
                        <h3 class="card-title text-success fs-3">Rs.75 OFF</h3>
                        <p class="card-text text-dark fs-5">Get Flat Discount of Rs.75 on Minimum Billing of Rs.399</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button type="button" class="btn btn-outline-success rounded-pill px-4 py-2" style="border-color: #BA8C63; color: #BA8C63;">Use Code EAT75</button>
                        <div class="percentage-icon" style="width: 80px; height: 80px; background-color: #d4edda; border-radius: 50%; display: flex; justify-content: center; align-items: center; opacity: 0.7;">
                            <span class="text-success fs-2 fw-bold">%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-4">
            <div class="card h-100 rounded" style="background-color: #f7f7f7;">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div>
                        <h3 class="card-title text-success fs-3">Rs.100 OFF</h3>
                        <p class="card-text text-dark fs-5">Get Flat Discount of Rs.100 on Minimum Billing of Rs.599.</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button class="btn btn-outline-success rounded-pill px-4 py-2" style="border-color: #BA8C63; color: #BA8C63;">Use Code EAT100</button>
                        <div class="percentage-icon" style="width: 80px; height: 80px; background-color: #d4edda; border-radius: 50%; display: flex; justify-content: center; align-items: center; opacity: 0.7;">
                            <span class="text-success fs-2 fw-bold">%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<footer class="py-5">
    <div class="container">
      <div class="row align-items-center">

        <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
          <h2 class="display-5 fw-bold mb-3 text-dark">Taste the convenience.</h2>
          <p class="lead mb-4 text-secondary">A leading platform in India that evolved from restaurant reviews to a comprehensive food delivery service, offering user-generated reviews and ratings, according to Medium.</p>
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


<!-- Reach Us  -->
 <h2 class="mt-4 pt-4 text-center mb-4 fw-bold h-font" id="contactus"> REACH US</h2>
    <div class="container ">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                <iframe height="360px" class="w-100 rounded" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3711.8789478073586!2d70.46042847504562!3d21.51246098026066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39580196e0464f39%3A0x884d1f8bdbff1e1b!2sShastri%20Swami%20Shree%20Dharmajivandasji%20Institute%20of%20Information%20Technology!5e0!3m2!1sen!2sin!4v1752057562446!5m2!1sen!2sin" loading="lazy"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-4 shadow">
                    <h5>Call Us</h5>
                    <a href="tel: +918200656607" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone"></i> +91 1112223331
                    </a>
                    <br>
                    <a href="tel: +918200656607" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone"></i> +91 1112223331
                    </a>
                </div>
                <div class="bg-white p-4 rounded mb-4 shadow">
                    <h5>Follow Us</h5>
                    <a href="#" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                           <i class="bi bi-twitter-x me-1"></i> Twitter
                        </span>
                    </a>
                    <br>
                    <a href="#" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                           <i class="bi bi-instagram me-1"></i> Instagram
                        </span>
                    </a>
                    <br>
                    <a href="#" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                           <i class="bi bi-facebook me-1"></i> Facebook
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>


<?php require('footer.php') ?>
</body>
</html>