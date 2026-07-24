<?php
$host = '127.0.0.1';
$port = '3306';
$user = 'root';
$pass = '';
$dbname = 'bootcamp';

try {
    $pdo = new PDO("mysql:host=$host;port=$port", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    $pdo->exec("USE `$dbname`");
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
