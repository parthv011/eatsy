<?php
session_start();
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $hashed);
    if ($stmt->fetch() && password_verify($password, $hashed)) {
        $_SESSION['user_id'] = $id;
        header("Location: ../frontend/menu.php");
    } else {
        echo "Invalid credentials";
    }
}
?>
