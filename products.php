<?php
session_start();
require_once 'db.php';
include('header.php');

$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $product) {
    echo "<div>";
    echo "<h3>" . htmlspecialchars($product['name']) . "</h3>";
    echo "<p>" . htmlspecialchars($product['description']) . "</p>";
    echo "<p>Price: $" . htmlspecialchars($product['price']) . "</p>";
    echo "<img src='" . htmlspecialchars($product['image_url']) . "' alt='" . htmlspecialchars($product['name']) . "' />";
    
    // Add to Cart button here
    echo "<p><a href='add_to_cart.php?product_id=" . $product['id'] . "'>Add to Cart</a></p>";

    echo "</div>";
}
?>
