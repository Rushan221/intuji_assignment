<?php

require './include.main.files.php';
include './assets/views/header.php';


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
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Your Upcoming Events</h3>
            <a href="./assets/views/form.php" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Add an Event</a>
        </div>
        <?php
        if (count($results->getItems()) == 0) {
            echo "<div class='card-body'><p>No upcoming events.</p></div>";
        } else {
            ?>
            <table class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Start Date Time</th>
                    <th>End Date Time</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($results->getItems() as $event) {
                    $startDateTime = new DateTime($event->start->dateTime);
                    $endDateTime = new DateTime($event->end->dateTime);
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($event->getSummary() ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($event->getDescription() ?? ''); ?></td>
                        <td><?php echo $startDateTime->format('Y-m-d H:i:s'); ?></td>
                        <td><?php echo $endDateTime->format('Y-m-d H:i:s'); ?></td>
                        <td>
                            <form action="./delete_event.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                <input type="hidden" name="event_id" value="<?php echo $event->getId();?>">
                                <button type="submit" class="btn btn-danger">Delete Event</button>
                            </form>

                        </td>
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