<?php
session_start();
require_once 'db.php';
include('header.php');

// Fetch all products from the database
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>All Products</h2>";
foreach ($products as $product) {
    // Vulnerable code: Outputting unsanitized user input
    echo "<div>";
    echo "<h3>" . $product['name'] . "</h3>";  // Displaying product name without sanitization
    echo "<p id='product-description'>" . $product['description'] . "</p>";  // Displaying product description without sanitization
    
    // Inject JavaScript to check for the XSS payload and show the flag
    echo "<script>
            // Check if description contains script tag (XSS)
            if (document.getElementById('product-description').innerHTML.includes('<script>')) {
                // If XSS payload is executed, show the CTF flag
                alert('CTF-Flag-1234: XSS Triggered!');
            }
          </script>";
    
    echo "</div>";
}
?>
