<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $level = $_POST['level'];

    $stmt = $conn->prepare('INSERT INTO petugas (username, password, email, nama_petugas, level) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('sssss', $username, password_hash($password, PASSWORD_BCRYPT), $email, $nama, $level);
    $stmt->execute();

    $stmt->close();
    $conn->close();
    header('Location: petugas.php');
}
?>