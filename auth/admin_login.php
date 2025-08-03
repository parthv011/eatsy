<?php
session_start();

// Default admin credentials (in production, store these securely in database with hashing)
$ADMIN_USERNAME = 'admin';
$ADMIN_PASSWORD = 'admin123';

// Check if admin is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit();
}

$error_message = '';
$success_message = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $remember_me = isset($_POST['remember_me']);
    
    // Validate credentials
    if (empty($username) || empty($password)) {
        $error_message = 'Please enter both username and password.';
    } elseif ($username === $ADMIN_USERNAME && $password === $ADMIN_PASSWORD) {
        // Successful login
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        $_SESSION['admin_login_time'] = time();
        
        // Set remember me cookie if requested
        if ($remember_me) {
            $cookie_value = base64_encode($username . ':' . hash('sha256', $password . 'salt'));
            setcookie('admin_remember', $cookie_value, time() + (30 * 24 * 60 * 60), '/'); // 30 days
        }
        
        // Redirect to dashboard
        header('Location: dashboard.php');
        exit();
    } else {
        $error_message = 'Invalid username or password. Please use the default credentials.';
    }
}

// Check for remember me cookie
if (!isset($_SESSION['admin_logged_in']) && isset($_COOKIE['admin_remember'])) {
    $cookie_data = base64_decode($_COOKIE['admin_remember']);
    $expected_cookie = $ADMIN_USERNAME . ':' . hash('sha256', $ADMIN_PASSWORD . 'salt');
    
    if ($cookie_data === $expected_cookie) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $ADMIN_USERNAME;
        $_SESSION['admin_login_time'] = time();
        header('Location: ../admin/dashboard.php');
        exit();
    }
}
?>