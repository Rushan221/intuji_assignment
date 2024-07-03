<?php

include './assets/views/header.php';
require './include.main.files.php';
?>

<div class="text-center">
    <h2>Connect your Google Account</h2>
    <?php
    if(isset($_SESSION['access_token'])) {
        header('Location: events.php');
        exit();
    } else {
        echo '<form action="google_oauth.php" method="get">';
        echo '<button class="btn btn-google btn-block btn-danger mt-3" type="submit"><i class="fab fa-google"></i> &nbsp; &nbsp;Login with Google</button>';
        echo '</form>';
    }
    ?>
</div>
