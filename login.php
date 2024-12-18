<?php

include 'config.php';
include 'redirect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$stmt = $conn->prepare('SELECT * FROM masyarakat WHERE email = ?');
	$stmt->bind_param('s', $email);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows > 0) {
		$user = $result->fetch_assoc();
		if (password_verify($password, $user['password'])) {
			$_SESSION['id'] = $user['id_masyarakat'];
			$_SESSION['username'] = $user['username'];
			header('Location: dashboard.php');
		} else {
			echo '<script>alert("Password salah");</script>';
		}
	} else {
		echo '<script>alert("Email tidak terdaftar");</script>';
	}
	$stmt->close();
	$conn->close();
}
?>

<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<title>Login</title>
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
			.login-container {
				display: flex;
				align-items: center;
				justify-content: center;
			}
			.login-image {
				margin-right: 2rem;
			}
			.login-image img {
				max-width: 100%;
				height: auto;
			}
			.login-form {
				max-width: 400px;
				width: 100%;
			}
			.login-form h2 {
				font-size: 1.5rem;
				margin-bottom: 1rem;
			}
			.login-form .logo {
				display: block;
				color: #6c63ff;
				font-size: 2rem;
				font-weight: bold;
				text-decoration: none;
			}
			.login-form .logo :hover {
				cursor: pointer;
			}
			.btn-google {
				background-color: #fff;
				color: #000;
				border: 1px solid #ddd;
				margin-bottom: 1rem;
				width: 100%;
				border-radius: 10px;
			}
			.btn-facebook {
				background-color: #fff;
				color: #000;
				border: 1px solid #ddd;
				margin-bottom: 1rem;
				width: 100%;
				border-radius: 10px;
			}
			.form-control {
				border-radius: 10px;
			}
			.btn-login {
				background-color: #6c63ff;
				color: #fff;
				border: none;
				width: 100%;
				border-radius: 10px;
			}
			.form-check-label {
				margin-left: 0.5rem;
			}
			.forgot-password {
				color: #6c63ff;
				text-decoration: none;
			}
			.register-link {
				color: #6c63ff;
				text-decoration: none;
			}
		</style>
	</head>
	<body>
		<!-- <div class="login-container">
			<div class="login-image">
				<img
					alt="Logo"
					height="300"
					src="https://storage.googleapis.com/a1aa/image/Nf8xbhVXuU20QyzQP8AEAgJtHCSz0yMrXwMXHp3OGnWcI59JA.jpg"
					width="300"
				/>
			</div> -->
			<div class="login-form">
				<h2>Welcome to <a class="logo" href="adminLogin.php">SILAPOR</a></h2>
				<form action="login.php" method="POST">
					<div class="mb-3">
						<label class="form-label" for="email">
							<i class="fas fa-envelope"></i> Email
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
							<i class="fas fa-key"></i> Password
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
					<div
						class="d-flex justify-content-between align-items-center mb-3"
					>
						<div class="form-check">
							<input
								class="form-check-input"
								id="rememberMe"
								type="checkbox"
							/>
							<label class="form-check-label" for="rememberMe"
								>Remember me</label
							>
						</div>
						<a class="forgot-password" href="#">Forgot Password?</a>
					</div>
					<button class="btn btn-login btn-block" type="submit">
						Login
					</button>
				</form>
				<div class="text-center mt-3">
					Belum Punya Akun?
					<a class="register-link" href="register.php">Register</a>
				</div>
				<div class="text-center my-3">OR</div>
				<button class="btn btn-google btn-block" onclick="location.href='<?php echo $url; ?>'">
						<i class="fab fa-google"></i> Login with Google
					</button>
			</div>
		</div>
	</body>
</html>
