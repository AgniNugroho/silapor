<?php
include '../config.php';

if (isset($_GET['id_pengaduan'])) {
    $query = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id_pengaduan = '" . $_GET['id_pengaduan'] . "'");
    $row = mysqli_fetch_array($query);
    $foto = $row['foto'];
    header("Content-type: image/jpeg");
    echo $foto;
} else {
    echo "Foto tidak ditemukan";
}
?>