<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['username'];
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

	$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

	$stmt = $conn->prepare('SELECT * FROM masyarakat WHERE email = ?');
	$stmt->bind_param('s', $email);
	$stmt->execute();
	
	$result = $stmt->get_result();

	if ($password != $confirm_password) {
		echo '<script>alert("Password tidak sama");</script>';
	} else {
		if ($result->num_rows > 0) {
			echo '<script>alert("Email sudah terdaftar");</script>';
		} else {
			$stmt = $conn->prepare('INSERT INTO masyarakat (username, nama_masyarakat, email, password) VALUES (?, ?, ?, ?)');
			$stmt->bind_param('ssss', $username, $fullname, $email, $hashedPassword);
			if ($stmt->execute()) {
				echo '<script>alert("Registrasi berhasil");window.location.replace("login.php");</script>';
			} else {
				echo '<script>alert("Error: ;$stmt->error");</script>';
			}
		}
	}
}
?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<title>Registrasi</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/all.min.css" rel="stylesheet" />
		<link
			href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
			rel="stylesheet"
		/>
		<style>
			body {
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100vh;
				background-color: #f8f9fa;
				font-family: "Poppins", sans-serif;
			}
			.container {
				display: flex;
				align-items: center;
				justify-content: center;
			}
			.image-container {
				margin-right: 2rem;
			}
			.image-container img {
				max-width: 100%;
				height: auto;
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
			.form-container .form-control {
				margin-bottom: 15px;
				border-radius: 10px;
			}
			.form-container .btn-primary {
				background-color: #6c63ff;
				border: none;
				border-radius: 10px;
				padding: 10px 0;
			}
			.form-container .form-check-label {
				margin-left: 5px;
			}
			.form-container .login-link {
				text-align: center;
				margin-top: 10px;
			}
			.form-container .login-link a {
				color: #6c63ff;
				text-decoration: none;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<!-- <div class="image-container">
				<img
					alt="Logo"
					height="300"
					src="https://storage.googleapis.com/a1aa/image/Nf8xbhVXuU20QyzQP8AEAgJtHCSz0yMrXwMXHp3OGnWcI59JA.jpg"
					width="300"
				/>
			</div> -->
			<div class="form-container">
				<h1>
					Welcome to
					<span> SILAPOR </span>
				</h1>
				<form action="register.php" method="POST">
					<div class="mb-3">
						<label class="form-label" for="username">
							<i class="fas fa-user"> </i>
							Username
						</label>
						<input
							class="form-control"
							id="username"
							placeholder="Lidzi"
							type="text"
							name="username"
							required
						/>
					</div>
					<div class="mb-3">
						<label class="form-label" for="fullname">
							<i class="fas fa-user"> </i>
							Nama lengkap
						</label>
						<input
							class="form-control"
							id="fullname"
							placeholder="Lidzi Gaming Bika Ambon"
							type="text"
							name="fullname"
							required
						/>
					</div>
					<div class="mb-3">
						<label class="form-label" for="email">
							<i class="fas fa-envelope"> </i>
							Email
						</label>
						<input
							class="form-control"
							id="email"
							placeholder="example@gmail.com"
							type="email"
							name="email"
							required
						/>
					</div>
					<div class="mb-3">
						<label class="form-label" for="password">
							<i class="fas fa-key"> </i>
							Password
						</label>
						<input
							class="form-control"
							id="password"
							placeholder="********"
							type="password"
							name="password"
							required
						/>
					</div>
					<div class="mb-3">
						<label class="form-label" for="confirm-password">
							<i class="fas fa-key"> </i>
							Konfirmasi Password
						</label>
						<input
							class="form-control"
							id="confirm-password"
							placeholder="********"
							type="password"
							name="confirm_password"
							required
						/>
					</div>
					<button class="btn btn-primary w-100" type="submit">
						Daftar
					</button>
					<div class="login-link">
						<p>
							Sudah Memiliki Akun?
							<a href="login.php"> Login </a>
						</p>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
