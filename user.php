<?php
session_start(); // Ensure the session is started

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if the user is not logged in
    exit;
}

// Get the username from the session
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Dashboard - The Online Kade</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <!-- Header -->
  <header>
    <div class="logo">
      <h1>The Online Kade</h1>
    </div>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li> <!-- Use .php if you're using PHP for pages -->
        <li><a href="cart.php">Cart</a></li> <!-- Use .php here too -->
        <li><a href="logout.php">Logout</a></li> <!-- This should link to logout.php -->
      </ul>
    </nav>
  </header>

  <!-- User Dashboard -->
  <section class="user-dashboard">
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2> <!-- Dynamically display username -->
    <p>Browse our latest products and manage your cart here.</p>
    <a href="index.php"><button>Start Shopping</button></a> <!-- Use .php if it's PHP page -->
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 The Online Kade</p>
  </footer>

</body>
</html>
