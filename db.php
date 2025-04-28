<?php
$host = 'localhost';
$db   = 'online_kade'; // <-- Change this to your real database name!
$user = 'root';               // <-- XAMPP default username
$pass = '';                   // <-- XAMPP default password is empty
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
