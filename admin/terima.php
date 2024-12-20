<?php
include "../config.php";

if (isset($_GET['id_pengaduan'])) {
    $query = mysqli_query($conn, "UPDATE pengaduan SET status = 'selesai' WHERE pengaduan.id_pengaduan = '" . $_GET['id_pengaduan'] . "'");
    header("location: laporan.php");
} else {
    exit("Halaman tidak dapat diakses!");
}
?>