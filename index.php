<?php

include './assets/views/header.php';
require './include.main.files.php';

if(isset($_SESSION['access_token'])) {
    header('Location: events.php');
    exit();
} else{
    echo '<form action="google_oauth.php" method="get">';
    echo '<button class="btn btn-primary" type="submit"><i class="fa-brands fa-google"></i>&nbsp;&nbsp;  Login with Google</button>';
    echo '</form>';
}
