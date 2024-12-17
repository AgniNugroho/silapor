<?php

include 'config.php';
include 'redirect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

	$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

	$stmt = $conn->prepare('SELECT * FROM masyarakat WHERE email = ?');
	$stmt->bind_param('s', $_SESSION['email']);
	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();

	if ($password != $confirm_password) {
		echo '<script>alert("Password tidak sama");</script>';
	} else {

		$stmt = $conn->prepare('UPDATE masyarakat SET password = ? WHERE email = ?');
		$stmt->bind_param('ss', $hashedPassword, $user['email']);
		$stmt->execute();

		$_SESSION['id'] = $user['id_masyarakat'];
		$_SESSION['username'] = $user['username'];
		header('Location: dashboard.php');
	}
	$stmt->close();
	$conn->close();
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
				padding: 10px 0;
			}
		</style>
	</head>
	<body>
		<div class="form-container">
			<h1>
				Welcome to
				<span> SILAPOR </span>
			</h1>
			<h2>Buat Password</h2>
			<form action="setPassword.php" method="POST">
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
					Konfirmasi
				</button>
			</form>
		</div>
	</body>
</html>
