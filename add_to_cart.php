<?php
session_start(); // Start session to manage the cart

// Example array of products (replace with actual database query if needed)
$products = [
    1 => ['name' => 'Sapphire Storm', 'price' => 20],
    2 => ['name' => 'Amber Blaze', 'price' => 25],
    3 => ['name' => 'Dusty Bloom', 'price' => 30]
];

// Check if a product ID is passed through the URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Check if the product exists in the array
    if (isset($products[$product_id])) {
        // Initialize cart if not already created
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Check if the product is already in the cart
        if (isset($_SESSION['cart'][$product_id])) {
            // Increase quantity if the product is already in the cart
            $_SESSION['cart'][$product_id]++;
        } else {
            // Add the product to the cart with quantity 1
            $_SESSION['cart'][$product_id] = 1;
        }
    }
}

// Redirect to the cart page after adding the item
header("Location: cart.php");
exit();
?>
