<?php

include 'config.php';
include 'redirect.php';

if (!isset($_SESSION['id'])) {
	header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
	
		$image_size = $_FILES['foto']['size'];
		if ($image_size > 2097152) {
			echo '<script>alert("Ukuran gambar terlalu besar. Maksimal 2MB");</script>';
			exit();
		} else {
			$image = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
			mysqli_query($conn, "UPDATE pengaduan SET foto='$image' WHERE id_masyarakat = " . $_SESSION['id']);
		}
		$conn->close();
		$habis_kirim = true;
		$_SESSION['habis_kirim'] = $habis_kirim;
		header('Location: lapor.php');
	}
}

?>

<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<title>SILAPOR</title>
		<link
			href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
			rel="stylesheet"
		/>
		<link
			rel="stylesheet"
			href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
		/>
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
			crossorigin="anonymous"
		/>
		<link href="assets/css/all.min.css" rel="stylesheet" />
		<script
			defer
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
			crossorigin="anonymous"
		></script>
		<script
			src="https://cdn.tiny.cloud/1/owzelfxv545o6js959rr14vltcorvd0ccthzbxzjdeon978f/tinymce/7/tinymce.min.js"
			referrerpolicy="origin"
		></script>
		<style>
			body {
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100vh;
				font-family: "Poppins", sans-serif;
				background-color: #ffffff;
				color: #333333;
			}
			.navbar {
				padding: 1rem 2rem;
				background-color: #ffffff;
			}
			.navbar span {
				color: #6c63ff; /* Adjust the font size as needed */
			}
			.navbar-brand {
				font-weight: bold;
				font-size: 2rem; /* Adjust the font size as needed */
			}
			.navbar-brand a {
				color: #6c63ff;
			}
			.navbar-nav .nav-link {
				margin-right: 1rem;
			}
			.container {
				display: flex;
				align-items: center;
				justify-content: center;
			}
			.form-container {
				max-width: 400px;
				width: 100%;
			}
			.form-container h1 {
				font-size: 1.5rem;
				margin-bottom: 1rem;
			}
			.form-container h1 span {
				display: block;
				color: #6c63ff;
				font-size: 2rem;
				font-weight: bold;
			}
			.form-container h2 {
				font-size: 1.2rem;
				margin-bottom: 1rem;
			}
			.form-container .form-control {
				margin-bottom: 15px;
				border-radius: 10px;
			}
			.form-container .btn-primary {
				background-color: #6c63ff;
				border: none;
				border-radius: 10px;
			}
		</style>
	</head>
	<body>
		<nav class="navbar fixed-top navbar-expand-lg navbar-light">
			<span
				><a class="navbar-brand" href="dashboard.php">
					SILAPOR
				</a></span
			>
			<div class="collapse navbar-collapse">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="nav-link" href="map.php"> Peta Interaktif </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="statusCheck.php"> Cek Status </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="dashboard.php#review"> Testimonial </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="dashboard.php#faqAccordion1"> FAQ </a>
					</li>
					<li class="nav-item dropdown">
						<div class="dropdown">
							<button
								class="btn dropdown-toggle"
								type="button"
								id="dropdownMenuButton"
								data-bs-toggle="dropdown"
								aria-expanded="false"
							>
								<?php echo $_SESSION['username']; ?>
							</button>
							<ul
								class="dropdown-menu dropdown-menu-end"
								aria-labelledby="dropdownMenuButton"
							>
								<li>
									<a class="nav-link logout" href="logout.php"
										>Logout</a
									>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</nav>
		<div class="form-container">
			<h1>Buat Laporan</h1>
			<form class="row g-3" action="lapor.php" method="POST" enctype="multipart/form-data">
				<div class="col-md-6">
					<label for="judul" class="form-label"
						>Judul Laporan</label
					>
					<input
						type="text"
						class="form-control"
						id="judul"
						name="judul"
						required
					/>
				</div>
				<div class="col-md-6">
					<label for="tanggal" class="form-label"
						>Tanggal</label
					>
					<input
						type="date"
						class="form-control"
						id="tanggal"
						name="tanggal"
						required
					/>
				</div>
				<div class="col-12">
					<label for="isi" class="form-label"
						>Isi Laporan</label
					>
					<textarea
						type="text"
						class="form-control"
						id="isi"
						name="isi"
						required
					></textarea>
				</div>
				<div class="col-12">
					<label for="lokasi" class="form-label"
						>Lokasi</label
					>
					<div id="map" style="width: 400px; height: 300px"></div>
				</div>
				<div class="col-md-6">
					<input
						type="text"
						class="form-control"
						id="longitude"
						name="longitude"
						placeholder="Longitude"
						readonly
						required
					/>
				</div>
				<div class="col-md-6">
				<input
						type="text"
						class="form-control"
						id="latitude"
						name="latitude"
						placeholder="Latitude"
						readonly
					/>	
				</div>
				<div class="col-mid-12">
					<select
						class="form-select"
						id="kategori"
						name="kategori"
						required
					>
						<option selected>Pilih Kategori</option>
						<?php 
							$sql = "SELECT * FROM kategori";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo "<option value='".$row['id_kategori']."'>".$row['nama_kategori']."</option>";
								}
							}
						?>
						
					</select>
				</div>
				<div class="col-md-9">
					<input
						type="file"
						class="form-control"
						id="foto"
						name="foto"
						required
					/>
				</div>
				<div class="col-md-3">
					<button type="submit" class="btn btn-primary" id="liveToastBtn">
						Submit
					</button>
				</div>
			</form>
		</div>
		<script>
			tinymce.init({
				selector: "#body",
				width: "100%",
				height: 270,
				plugins: "link",
				statusbar: false,
				toolbar: "link",
			});

			$(document).on("focusin", function (e) {
				if (
					$(e.target).closest(
						".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root"
					).length
				) {
					e.stopImmediatePropagation();
				}
			});
		</script>
		<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
		<script src="map-config.js"></script>
	</body>
</html>
