<?php
session_start();
include "../config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM petugas WHERE petugas.id_petugas = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
    header('Location: petugas.php');
}
?>