<?php
session_start();
session_unset();  // Clears all session variables
session_destroy(); // Destroys the session

// Redirect to login page
header("Location: ../frontend/login.php?logout=1");
exit;
