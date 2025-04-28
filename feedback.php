<?php
session_start();
require_once 'db.php'; // database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data directly (without sanitization)
    $username = $_POST['username'];  // Unsafe input (SQL Injection possible)
    $email = $_POST['email'];        // Unsafe input (SQL Injection possible)
    $message = $_POST['message'];    // Unsafe input (SQL Injection possible)

    // SQL Injection Vulnerable Query (concatenating user inputs directly into the query)
    $sql = "INSERT INTO feedback (username, email, message) VALUES ('$username', '$email', '$message')";
    
    // Execute the SQL query directly without prepared statements
    $stmt = $pdo->query($sql);

    $success_message = "Thank you for your feedback!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback - The Online Kade</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>Send Us Your Feedback</h1>
</header>

<section>
    <?php if (isset($success_message)): ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php endif; ?>

    <form method="post" action="feedback.php">
        <label for="username">Your Name:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Your Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Your Message:</label><br>
        <textarea id="message" name="message" rows="5" required></textarea><br><br>

        <button type="submit">Submit Feedback</button>
    </form>
</section>

</body>
</html>
