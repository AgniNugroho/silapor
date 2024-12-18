<?php
include 'config.php';
include 'redirect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("This page can only be accessed via POST method");
}

if (!isset($_FILES['foto']['tmp_name'])) {
	echo '<script>alert("Foto tidak boleh kosong");</script>';
} else {
	$judul = $_POST['judul'];
	$tanggal = $_POST['tanggal'];
	$isi = $_POST['isi'];
	$longitude = $_POST['longitude'];
	$latitude = $_POST['latitude'];
	$kategori = $_POST['kategori'];
	
	$stmt = $conn->prepare('INSERT INTO pengaduan (judul_pengaduan, tanggal_pengaduan, isi_pengaduan, longitude, latitude, id_kategori, id_masyarakat) VALUES (?, ?, ?, ?, ?, ?, ?)');
	$stmt->bind_param('sssssii', $judul, $tanggal, $isi, $longitude, $latitude, $kategori, $_SESSION['id']);
	$stmt->execute();
    $stmt->close();

    $image = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
	mysqli_query($conn, "UPDATE pengaduan SET foto='$image' WHERE id_masyarakat = " . $_SESSION['id']);
	$conn->close();
    header('Location: dashboard.php');
}
?>