<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Eastys</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap + Font + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #ffe0b3, #f9f9f9);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .card-register {
      background-color: white;
      padding: 40px 30px;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 450px;
      animation: fadeIn 0.7s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .card-register h2 {
      text-align: center;
      color: #ff6f61;
      margin-bottom: 20px;
    }

    .form-control {
      border-radius: 10px;
    }

    .btn-register {
      width: 100%;
      background-color: #ff6f61;
      color: white;
      border-radius: 10px;
      margin-top: 20px;
    }

    .btn-register:hover {
      background-color: #e85c50;
    }
  </style>
</head>
<body>

  <div class="card-register">
    <h2><i class="fas fa-user-plus me-2"></i>Register</h2>
    <?php if (isset($_GET['error'])): ?>
  <div class="alert alert-danger text-center"><?php echo $_GET['error']; ?></div>
<?php endif; ?>

    <form action="../auth/register.php" method="POST">
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">Choose Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Create Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-register mt-3">Register</button>
    <div class="text-center mt-3">
        <p>Already have an account? <a href="login.php">Login</a></p>
      </div>
    </form>
  </div>

</body>
</html>
