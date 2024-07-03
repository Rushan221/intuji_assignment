<?php
include './assets/views/header.php';


require './include.main.files.php';

$client = new Google_Client();
$client->setAuthConfig('./credentials.json');
$client->addScope(Google_Service_Calendar::CALENDAR);

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
    if ($client->isAccessTokenExpired()) {
        $refreshToken = $client->getRefreshToken();
        $client->fetchAccessTokenWithRefreshToken($refreshToken);
        $_SESSION['access_token'] = $client->getAccessToken();
    }

    $service = new Google_Service_Calendar($client);

    $calendarId = 'primary';
    $optParams = array(
        'maxResults' => 10,
        'orderBy' => 'startTime',
        'singleEvents' => true,
        'timeMin' => date('c'),
    );
    $results = $service->events->listEvents($calendarId, $optParams);

    if(isset($_SESSION['access_token'])) {
    ?>
        <a href="./disconnect_google.php" class="btn btn-danger btn-sm mb-3"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Disconnect Google</a>
    <?php
    }
    ?>
    <div class="card">
        <div class="card-header"><h3>Your Upcoming Events</h3>
            <a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Add an Event</a>
        </div>
        <?php
        if (count($results->getItems()) == 0) {
            echo "<div class='card-body'><p>No upcoming events.</p></div>";
        } else {
            ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($results->getItems() as $event) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($event->getSummary() ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($event->getDescription() ?? ''); ?></td>
                        <td><a href="#" class="btn btn-danger btn-sm">Delete</a></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>

            </table>
            <?php
        }
        ?>
    </div>
    <?php
} else {
    header('Location: index.php');
    exit();
}

include './assets/views/footer.php' ?>