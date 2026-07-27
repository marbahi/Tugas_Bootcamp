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

    $pdo->exec("CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        customer_name VARCHAR(255) NOT NULL,
        alamat TEXT NOT NULL,
        metode_pengiriman VARCHAR(100) NOT NULL,
        metode_pembayaran VARCHAR(100) NOT NULL,
        total_harga DECIMAL(12,2) NOT NULL,
        status ENUM('pending','diproses','dikirim','selesai','dibatalkan') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS order_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT NOT NULL,
        produk_id INT NOT NULL,
        nama_produk VARCHAR(255) NOT NULL,
        harga DECIMAL(12,2) NOT NULL,
        qty INT NOT NULL,
        subtotal DECIMAL(12,2) NOT NULL,
        FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
    )");
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
