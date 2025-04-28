<?php
session_start();
include 'db.php';  // your DB connection

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['username']) && isset($_GET['password'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];

    // Vulnerable Code: Directly concatenating user input into SQL query (This is the insecure part)
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $stmt = $pdo->query($sql);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];  // Set the role in the session

        // Redirect based on user role
        if ($user['role'] === 'admin') {
            header("Location: admindashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit;
    } else {
        echo "User not found.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - My Online Shop</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Header -->
<header>
  <div class="logo">
    <h1>My Online Shop</h1>
  </div>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="cart.php">Cart</a></li>
    </ul>
  </nav>
</header>

<!-- Login Form -->
<section class="login-form">
  <h2>Login to Your Account</h2>
  <form action="login.php" method="GET">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required />
    <br />
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" />
    <br />
    <button type="submit">Login</button>
  </form>
</section>

<!-- Footer -->
<footer>
  <p>&copy; 2025 My Online Shop</p>
</footer>

</body>
</html>
