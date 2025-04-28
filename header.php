<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <h1>Welcome to the Online Shop</h1>
        <nav>
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="download.php?file=hello.txt">Download</a></li>

                <!-- Admin Links (only shown if user is admin) -->
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true): ?>
                    <li><a href="admin_add_product.php">Add Product</a></li>
                    <li><a href="admin_view_products.php">View Products</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
