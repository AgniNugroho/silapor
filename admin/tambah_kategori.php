<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kategori = $_POST['categoryName'];

    $stmt = $conn->prepare('INSERT INTO kategori (nama_kategori) VALUES (?)');
    $stmt->bind_param('s', $nama_kategori);
    $stmt->execute();

    $stmt->close();
    $conn->close();
    header('Location: kategori.php');
} else {
    exit("Halaman hanya bisa diakses melalui POST method!");
}
?>