<?php
session_start();
require_once 'db.php';
include('header.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];  // Capture the image URL from the form

    // Insert new product into the database with the image_url
    $sql = "INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $description, $price, $image_url]);

    echo "Product added successfully!";
}
?>

<!-- Add Product Form -->
<form method="POST" action="admin_add_product.php">
    <label for="name">Product Name:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea><br>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" step="0.01" required><br>

    <label for="image_url">Image URL:</label>
    <input type="text" id="image_url" name="image_url" required><br> <!-- New field for Image URL -->

    <button type="submit">Add Product</button>
</form>
