<?php
include 'config.php';
include 'redirect.php';

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
			.table {
				width: 75%;
				margin: auto;
			}
			.judul {
				text-align: center;
				margin-top: 0px;
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
						<a class="nav-link active" href="map.php"> Peta Interaktif </a>
					</li>
					<li class="nav-item"> 	
						<a class="nav-link" href="statusCheck.php">
							Cek Status
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="dashboard.php#review">
							Testimonial
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="dashboard.php#faqAccordion1">
							FAQ
						</a>
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
        <div id="map" style="width: 100%; height: 100vh"></div>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
		<script>
            let mapOptions = {
	           center: [-7.811684223567514, 110.37277221679689],
	            zoom: 10,
            };

            let map = new L.map("map", mapOptions);
            let layer = new L.TileLayer(
	            "http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
            );
            
            map.addLayer(layer);

            <?php
            $query = "SELECT * FROM pengaduan JOIN kategori ON pengaduan.id_kategori = kategori.id_kategori WHERE status = 'selesai'";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo 'L.marker([' . $row['latitude'] . ', ' . $row['longitude'] . ']).addTo(map).bindPopup("' . $row['nama_kategori'] . '");';
            }
            ?>
        </script>
	</body>
</html>