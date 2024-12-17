<?php

require_once 'vendor/autoload.php';

// init configuration
$clientID = $_ENV['CLIENT_ID'];
$clientSecret = $_ENV['CLIENT_SECRET'];
$redirectUri = 'http://localhost/tes/silapor/redirect.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

$url = $client->createAuthUrl();

$conn = mysqli_connect(
    $_ENV['DB_HOST'],
    $_ENV['DB_USERNAME'],
    $_ENV['DB_PASSWORD'],
    $_ENV['DB_NAME']
);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>