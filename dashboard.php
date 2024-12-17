<?php
session_start();
include 'config.php';

if (!isset($_SESSION['id'])) {
	header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>SiLapor</title>
	</head>
	<body>
		<p>
			Halo, <?php echo $_SESSION['username']; ?>
		</p>
	</body>
</html>
