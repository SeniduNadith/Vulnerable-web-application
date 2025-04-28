<?php
session_start();

// Check if the user is logged in and has admin rights
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Redirect to login if the user is not logged in as admin
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - The Online Kade</title>
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
      <li><a href="index.php">Home</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>
</header>

<!-- Admin Panel -->
<section>
  <h2>Welcome, Admin!</h2>
  <p>Hello, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! You are successfully logged in as an admin.</p>
  <p>This is the admin panel where you can manage various features of the website.</p>
  
  <!-- Admin Actions -->
  <div class="admin-buttons">
    <!-- Link to Add New Product -->
    <a href="admin_add_product.php"><button>Add New Product</button></a>
    
    <!-- Link to View All Products -->
    <a href="admin_view_products.php"><button>View All Products</button></a>
  </div>
</section>

</body>
</html>
