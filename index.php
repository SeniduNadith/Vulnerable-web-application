<?php
session_start();
require_once 'db.php'; // Include database connection

// Initialize products array
$products = [];

// Fetch all products from the database initially
try {
    $stmt = $pdo->query("SELECT * FROM products");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $image = 'images/product' . $row['id'] . '.webp'; // Adjust to your image format (e.g., .jpg, .png, .webp)
        $products[$row['id']] = [
            'name' => $row['name'],
            'price' => $row['price'],
            'image' => $image
        ];
    }
} catch (PDOException $e) {
    echo "Database query failed: " . $e->getMessage();
}

// Add product to cart functionality
if (isset($_GET['add_to_cart'])) {
    $product_id = (int)$_GET['add_to_cart']; // Ensure product_id is an integer

    if (isset($products[$product_id])) {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

        try {
            $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
            $stmt->execute([$user_id, $product_id]);

            if ($stmt->rowCount() > 0) {
                $update = $pdo->prepare("UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?");
                $update->execute([$user_id, $product_id]);
            } else {
                $insert = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)");
                $insert->execute([$user_id, $product_id]);
            }

            header("Location: index.php");
            exit;
        } catch (PDOException $e) {
            echo "Cart update failed: " . $e->getMessage();
        }
    } else {
        echo "Invalid product ID.";
    }
}

// Display cart item count
$cart_count = 0;
if (isset($_SESSION['user_id'])) {
    try {
        $stmt = $pdo->prepare("SELECT SUM(quantity) AS total FROM cart WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $cart_count = $result['total'] ? $result['total'] : 0;
    } catch (PDOException $e) {
        echo "Cart count query failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The Online Kade</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      position: relative;
    }
    nav {
      flex-grow: 1;
    }
    .logo h1 {
      margin: 0;
    }
    .products {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      margin: 20px;
    }
    .product {
      border: 1px solid #ccc;
      padding: 20px;
      margin: 10px;
      width: 200px;
      text-align: center;
    }
    .product img {
      width: 100%;
      height: auto;
    }
    .product a button {
      display: block;
      width: 100%;
      margin-top: 8px;
      padding: 10px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .product a:first-child button {
      margin-bottom: 8px; /* Add space between the two buttons */
    }

    /* Help & Contact button style */
    .help-btn {
      position: fixed;
      bottom: 80px;
      left: 20px;
      padding: 10px 20px;
      background-color: #28a745;
      color: white;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      transition: background-color 0.3s ease;
    }

    .help-btn:hover {
      background-color: #218838;
    }

    /* Footer Style */
    footer {
      text-align: center;
      padding: 10px;
      background-color: #f8f9fa;
      margin-top: 20px;
    }
  </style>
</head>
<body>

<header>
  <div class="logo">
    <h1>The Online Kade</h1>
  </div>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="login.php">Login</a></li>
      <li><a href="cart.php">Cart (<?php echo $cart_count; ?>)</a></li>
      <li><a href="user.php">User</a></li>
      <li><a href="admin.php">Admin</a></li>
      <li><a href="feedback.php">Feedback</a></li>
      <li><a href="search.php">Search</a></li> <!-- Search Button -->
    </ul>
  </nav>
</header>

<section class="products">
  <h2>Featured Products</h2>
  <div class="product-list">
    <?php if (empty($products)): ?>
      <p>No products found.</p>
    <?php else: ?>
      <?php foreach ($products as $id => $product): ?>
        <div class="product">
          <img src="<?php echo file_exists($product['image']) ? $product['image'] : 'images/default.jpg'; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
          <h3><?php echo htmlspecialchars($product['name']); ?></h3>
          <p>$<?php echo number_format($product['price'], 2); ?></p>
          <a href="index.php?add_to_cart=<?php echo $id; ?>">
            <button>Add to Cart</button>
          </a>
          <a href="product_details.php?id=<?php echo $id; ?>">
            <button>View Details</button>
          </a>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<!-- Help & Contact Button -->
<a href="help_contact.php">
  <button class="help-btn">Help & Contact</button>
</a>

<!-- Footer -->
<footer>
  <p>&copy; 2025 The Online Kade. All rights reserved.</p>
</footer>

</body>
</html>
