<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["attachment"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["attachment"]["name"]);

    if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
        $upload_message = "Thanks! We'll check your file: <a href='$target_file'>" . htmlspecialchars(basename($_FILES["attachment"]["name"])) . "</a>";
    } else {
        $upload_message = "Error uploading the file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Help & Contact</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ece9e6, #ffffff);
            min-height: 100vh;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: #ffffff;
            padding: 40px;
            width: 100%;
            max-width: 600px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        a.back-button {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007bb5;
            color: white;
            border-radius: 8px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 20px;
            transition: background-color 0.3s;
        }

        a.back-button:hover {
            background-color: #005f8d;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #007bb5;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #005f8d;
        }

        .message {
            padding: 15px;
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            border-radius: 8px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <a href="index.php" class="back-button">Back</a>

    <h2>Contact Support</h2>
    <p>If you're facing issues, send us a message. You can attach a file (e.g., screenshot or log).</p>

    <form method="post" enctype="multipart/form-data">
        <label>Your Name:</label>
        <input type="text" name="name" required>

        <label>Message:</label>
        <textarea name="message" rows="5" required></textarea>

        <label>Attachment:</label>
        <input type="file" name="attachment">

        <input type="submit" value="Submit">
    </form>

    <?php 
    if (!empty($upload_message)) {
        echo "<div class='message'>$upload_message</div>";
    }
    ?>
</div>
</body>
</html>
