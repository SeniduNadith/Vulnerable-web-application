<?php
session_start();
include 'db.php';  // Your DB connection

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id']; // Get product ID from URL (vulnerable)

    // Query to get product details
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $stmt = $pdo->query($sql);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo "<h1>" . htmlspecialchars($product['name']) . "</h1>";
        echo "<p>" . htmlspecialchars($product['description']) . "</p>";
        echo "<p>Price: $" . number_format($product['price'], 2) . "</p>";
    } else {
        echo "Product not found.";
    }
} else {
    echo "No product ID specified.";
}
?>

<!-- Optional: Add a back button or link to return to the homepage -->
<a href="index.php">Back to Homepage</a>
