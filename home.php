<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to Eatsy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f9f9f9, #ffe0b3);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }

    .welcome-card {
      background-color: #ffffff;
      padding: 50px 30px;
      border-radius: 25px;
      box-shadow: 0 8px 40px rgba(0, 0, 0, 0.1);
      max-width: 450px;
      width: 90%;
      text-align: center;
      animation: slideIn 1s ease;
    }

    @keyframes slideIn {
      0% {
        transform: translateY(50px);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .welcome-card h1 {
      font-size: 2.8rem;
      font-weight: 600;
      color: #ff6f61;
      margin-bottom: 10px;
    }

    .welcome-card p {
      font-size: 1rem;
      color: #555;
      margin-bottom: 30px;
    }

    .btn-custom {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      font-size: 1rem;
      border-radius: 10px;
      transition: 0.3s;
    }

    .btn-userlogin {
      background-color: #ffffff;
      border: 2px solid #4bcf7f;
      color: #4bcf7f;
    }

    .btn-userlogin:hover {
      background-color: #4bcf7f;
      color: #fff;
    }

    .btn-adminlogin {
      background-color: #ffffff;
      border: 2px solid #e20e0eff;
      color: #f02613ff;
    }

    .btn-adminlogin:hover {
      background-color: #f82a17ff;
      color: #fff;
    }

    .food-icon {
      font-size: 50px;
      color: #ff6f61;
      margin-bottom: 20px;
    }

    @media (max-width: 576px) {
      .welcome-card {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

  <div class="welcome-card">
    <div class="food-icon"><i class="fas fa-utensils"></i></div>
    <h1>Welcome to Eatsy</h1>
    <p>Your favorite meals delivered with love 🍽️</p>
    
    <a href="users/login.php" class="btn btn-custom btn-userlogin"><i class="fas fa-user"></i>Users</a>
    <a href="admin/admin_login.php" class="btn btn-custom btn-adminlogin"><i class="fas fa-user-tie"></i>Admins</a>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
