<?php
session_start();
include 'config.php';

// authenticate code from Google OAuth Flow
if (isset($_GET['code']) && !empty($_GET['code'])) {
    $client->authenticate($_GET['code']);
    if ($client->getAccessToken()) {
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
    }
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();

  $email = $google_account_info->email;
  $username = $google_account_info->givenName;
  $fullname = $google_account_info->name;

  // checking if user is already exists in database
  $sql = "SELECT * FROM masyarakat WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    // user is exists
    $user = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $user['id_masyarakat'];
	  $_SESSION['username'] = $user['username'];
	  header('Location: dashboard.php');
  } else {
    // user is not exists
    $stmt = $conn->prepare('INSERT INTO masyarakat (username, nama_masyarakat, email) VALUES (?, ?, ?)');
		$stmt->bind_param('sss', $username, $fullname, $email);
    $stmt->execute();
    $stmt->close();

    $_SESSION['email'] = $email;
    header('Location: setPassword.php');
  }
}
?>