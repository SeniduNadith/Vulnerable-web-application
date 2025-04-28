<?php
session_start();

// Clear the session data
session_unset();   // Removes all session variables
session_destroy(); // Destroys the session

// Redirect to the login page
header("Location: login.php");
exit;
?>
