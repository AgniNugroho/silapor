<?php
session_start();
include "../config.php"
?>

<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <style>
        body {
            display: flex;
        }
        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: #343a40;
            color: white;
            height: 100vh;
            position: fixed;
            transition: all 0.3s;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .sidebar .nav-link {
            padding: 15px;
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link .icon {
            width: 30px;
            display: flex;
            justify-content: center;
        }
        .sidebar .nav-link.active {
            background-color: #495057;
            border-left: 4px solid #007bff;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
            transition: all 0.3s;
        }
        .sidebar.collapsed {
            margin-left: -250px;
        }
        .content.expanded {
            margin-left: 0;
        }
        .btn-custom {
            background-color: white;
            color: black;
            border: 2px solid transparent;
            transition: border-color 0.3s;
            margin-left: 15px; /* Adjusted margin to align with the card */
        }
        .btn-custom:hover {
            border-color: black;
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <h3 class="text-center py-3">Hai, <?php echo $_SESSION['username']; ?>!</h3>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <div class="icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <div class="icon"><i class="fas fa-file-alt"></i></div>
                    Laporan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="petugas.php">
                    <div class="icon"><i class="fas fa-user-shield"></i></div>
                    Petugas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">
                    <div class="icon"><i class="fas fa-sign-out-alt"></i></div>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <div class="content" id="content">
        <button class="btn btn-custom mb-3" id="toggleSidebar"><i class="fas fa-bars"></i></button>
        <table class="table table-bordered">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Judul</th>
					<th scope="col">Isi Laporan</th>
                    <th scope="col">Pelapor</th>
                    <th scope="col">Kategori</th>
					<th scope="col">Tanggal</th>
					<th scope="col">Lokasi</th>
                    <th scope="col">Gambar</th>
					<th scope="col">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				$id = $_SESSION['id'];
				$query = "SELECT * FROM pengaduan JOIN masyarakat ON masyarakat.id_masyarakat = pengaduan.id_masyarakat JOIN kategori ON kategori.id_kategori = pengaduan.id_kategori WHERE status = 'proses'";
				$result = mysqli_query($conn, $query);
				while ($row = mysqli_fetch_array($result)) {
					?>
					<tr>
						<?php
						$lokasi = "https://www.google.com/maps/search/?api=1&query=" . $row['latitude'] . "," . $row['longitude'];
						?>
						<th scope="row"><?php echo $no++; ?></th>
						<td><?php echo $row['judul_pengaduan']; ?></td>
						<td><?php echo $row['isi_pengaduan']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['nama_kategori']; ?></td>
						<td><?php echo $row['tanggal_pengaduan']; ?></td>
						<td><a href="<?php echo $lokasi?>">Lihat di Google Maps</a></td>
                        <td><img src="foto.php?id_pengaduan=<?php echo $row['id_pengaduan']; ?>" alt="Foto" width="100"></td>
                        <td>
                            <a href="tolak.php?id_pengaduan=<?php echo $row['id_pengaduan']; ?>" class="btn btn-danger">Tolak</a>
                            <a href="terima.php?id_pengaduan=<?php echo $row['id_pengaduan']; ?>" class="btn btn-success">Terima</a>
                        </td>
                <?php
                }
                ?>
			</tbody>
		</table>
    </div>
</body>