<?php
session_start();

// Check if the user is logged in and is a regular user
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header('Location: login.php'); // Redirect to login if not logged in as a user
    exit;
}

// Get username and user_id from session
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];  // Assuming user_id is stored in session
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard - The Online Kade</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .cart-button {
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-size: 16px;
      margin-top: 20px;
      display: inline-block;
    }

    .cart-button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <h1>Welcome to Your Dashboard</h1>
  </header>

  <section>
    <h2>Login Successful! 🎉</h2>
    <p>Hello, <strong><?php echo htmlspecialchars($username); ?></strong>! You have successfully logged in.</p>

    <!-- Cart Button with user_id as a query parameter -->
    <a href="cart.php?user_id=<?php echo $user_id; ?>" class="cart-button">Go to Your Cart</a>

    <br><br>
    <a href="logout.php">Logout</a>
  </section>

</body>
</html>
