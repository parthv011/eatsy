<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'project_db';  // 🔁 Change this to your actual database name

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
