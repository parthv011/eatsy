<?php
session_start();

// Clear all admin session data
unset($_SESSION['admin_logged_in']);
unset($_SESSION['admin_username']);
unset($_SESSION['admin_login_time']);

// Clear remember me cookie if exists
if (isset($_COOKIE['admin_remember'])) {
    setcookie('admin_remember', '', time() - 3600, '/');
}

// Destroy the session
session_destroy();

// Set a temporary cookie to show logout message
setcookie('logout_message', 'You have been successfully logged out.', time() + 60, '/');

// Redirect to login page
header('Location: login.php');
exit();
?>