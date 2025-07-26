<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - EATSY</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 450px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo h1 {
            color: #e62e4a;
            font-weight: bold;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .brand-logo p {
            color: #666;
            font-size: 1rem;
            margin: 0;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #e62e4a;
            box-shadow: 0 0 0 0.2rem rgba(230, 46, 74, 0.25);
        }

        .btn-login {
            background: linear-gradient(135deg, #e62e4a, #cf2941);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(230, 46, 74, 0.3);
            background: linear-gradient(135deg, #cf2941, #be253a);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .admin-icon {
            color: #e62e4a;
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .default-credentials {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .default-credentials h6 {
            color: #495057;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .credential-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .credential-item:last-child {
            margin-bottom: 0;
        }

        .credential-value {
            font-family: 'Courier New', monospace;
            background: #e9ecef;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .copy-btn {
            background: none;
            border: none;
            color: #6c757d;
            font-size: 0.8rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .copy-btn:hover {
            color: #e62e4a;
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .back-link {
            text-align: center;
            margin-top: 1rem;
        }

        .back-link a {
            color: #6c757d;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .back-link a:hover {
            color: #e62e4a;
        }

        @media (max-width: 576px) {
            .login-container {
                margin: 1rem;
                padding: 2rem;
            }
            
            .brand-logo h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Brand Logo -->
        <div class="brand-logo">
            <i class="fas fa-shield-alt admin-icon"></i>
            <h1>EATSY</h1>
            <p>Admin Panel Login</p>
        </div>
        <!-- Login Form -->
        <form id="adminLoginForm" method="POST">
            <!-- Error/Success Messages -->
            <div id="messageArea"></div>
            <!-- Username Field -->
            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="username" 
                       placeholder="Username" value="admin" required>
                <label for="username">
                    <i class="fas fa-user me-2"></i>Username
                </label>
            </div>
            <!-- Password Field -->
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" 
                       placeholder="Password" value="admin123" required>
                <label for="password">
                    <i class="fas fa-lock me-2"></i>Password
                </label>
            </div>

            <!-- Remember Me Checkbox -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me">
                <label class="form-check-label" for="rememberMe">
                    Remember me
                </label>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>Login to Dashboard
            </button>
        </form>

        <!-- Back to Site Link -->
        <div class="back-link">
            <a href="../home.php">
                <i class="fas fa-arrow-left me-1"></i>Back to Main Site
            </a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Copy to clipboard function
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Show temporary success message
                showMessage('Copied to clipboard!', 'success', 2000);
            });
        }

        // Show message function
        function showMessage(message, type = 'info', duration = 5000) {
            const messageArea = document.getElementById('messageArea');
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            messageArea.innerHTML = '';
            messageArea.appendChild(alertDiv);
            
            // Auto remove after duration
            if (duration) {
                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        alertDiv.remove();
                    }
                }, duration);
            }
        }

        // Handle form submission
        document.getElementById('adminLoginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Simple validation (you should implement proper server-side validation)
            if (username === 'admin' && password === 'admin123') {
                showMessage('Login successful! Redirecting to dashboard...', 'success');
                
                // Simulate server processing
                setTimeout(() => {
                    // In a real application, you would:
                    // 1. Send credentials to server
                    // 2. Set session/token
                    // 3. Redirect to admin dashboard
                    
                    // For demo purposes, redirect to a dashboard page
                    window.location.href = 'dashboard.php';
                }, 1500);
            } else {
                showMessage('Invalid username or password. Please use the default credentials.', 'danger');
            }
        });

        // Auto-fill credentials button
        function fillCredentials() {
            document.getElementById('username').value = 'admin';
            document.getElementById('password').value = 'admin123';
            showMessage('Default credentials filled!', 'info', 2000);
        }

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl + D to fill default credentials
            if (e.ctrlKey && e.key === 'd') {
                e.preventDefault();
                fillCredentials();
            }
        });

        // Show welcome message on page load
        window.addEventListener('load', function() {
            showMessage('Welcome to EATSY Admin Panel. Use the default credentials to login.', 'info', 4000);
        });
    </script>
</body>
</html>