<?php

require './include.main.files.php';

if(isset($_SESSION['access_token'])) {
    $accessToken = $_SESSION['access_token']['access_token'];
    $client = new Google_Client();
    $client->setAuthConfig('./credentials.json');
    $client->addScope(Google_Service_Calendar::CALENDAR);

    // Revoke the token
    $client->revokeToken($accessToken);

    // Clear the session
    unset($_SESSION['access_token']);

    // Redirect to the login page or home page
    header('Location: index.php');
    exit();
}
