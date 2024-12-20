<?php
session_start();
include "../config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("UPDATE petugas SET nama_petugas = ?, username = ?, password = ?, level = ? WHERE id_petugas = ?");
    $stmt->bind_param("ssssi", $nama, $username, $password, $level, $id);
    $stmt->execute();

    $stmt->close();
    $conn->close(); 
    header('Location: petugas.php'); 
}
?>