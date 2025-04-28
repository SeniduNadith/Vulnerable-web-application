<?php
session_start();
require_once 'db.php'; // Include database connection

// Get the user_id from URL, or fallback to session if not set
if (isset($_GET['user_id'])) {
    $user_id = (int)$_GET['user_id']; // Sanitize user_id from URL
} elseif (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Fallback to session user_id if available
} else {
    header('Location: login.php'); // Redirect to login if no user_id is found
    exit;
}

// Fetch all products in cart for the given user_id
$stmt = $pdo->prepare("SELECT c.quantity, p.name, p.price, p.id AS product_id, c.user_id FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle removing from cart
if (isset($_GET['remove_from_cart'])) {
    $product_id = (int)$_GET['remove_from_cart'];
    $delete = $pdo->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
    $delete->execute([$user_id, $product_id]);
}

// Calculate cart total
$grand_total = 0;
foreach ($cart_items as $item) {
    $grand_total += $item['price'] * $item['quantity'];
}

// Display cart item count
$cart_count = 0;
$stmt = $pdo->prepare("SELECT SUM(quantity) AS total FROM cart WHERE user_id = ?");
$stmt->execute([$user_id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$cart_count = $result['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart - The Online Kade</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
  <h1>The Online Kade</h1>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="login.php">Login</a></li>
      <!-- Cart link directly pointing to user-specific cart -->
      <li><a href="cart.php?user_id=<?php echo $user_id; ?>">Cart (<?php echo $cart_count; ?>)</a></li>
    </ul>
  </nav>
</header>

<section class="cart">
  <h2>Your Shopping Cart</h2>

  <?php if (!empty($cart_items)): ?>
    <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <th>User ID</th> <!-- Add this column to display the user_id -->
        <th>Product</th>
        <th>Quantity</th>
        <th>Price Each</th>
        <th>Total</th>
        <th>Action</th>
      </tr>

      <?php foreach ($cart_items as $item): ?>
        <tr>
          <td><?php echo $item['user_id']; ?></td> <!-- Display user_id -->
          <td><?php echo htmlspecialchars($item['name']); ?></td>
          <td><?php echo $item['quantity']; ?></td>
          <td>$<?php echo number_format($item['price'], 2); ?></td>
          <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
          <td><a href="cart.php?user_id=<?php echo $user_id; ?>&remove_from_cart=<?php echo $item['product_id']; ?>">Remove</a></td>
        </tr>
      <?php endforeach; ?>
    </table>

    <p><strong>Total: $<?php echo number_format($grand_total, 2); ?></strong></p>
    <!-- Removed inner cart button here -->
    <a href="index.php"><button>Continue Shopping</button></a>

  <?php else: ?>
    <p>Your cart is empty.</p>
    <a href="index.php"><button>Continue Shopping</button></a>
  <?php endif; ?>

</section>

</body>
</html>
