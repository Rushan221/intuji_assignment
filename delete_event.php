<?php

use Google\Service\Calendar;

require './include.main.files.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    $client = new Google_Client();
    $client->setAuthConfig('./credentials.json');
    $client->addScope(Google_Service_Calendar::CALENDAR);
    $client->setAccessType('offline');
    $client->setAccessToken($_SESSION['access_token']);
    $service = new Calendar($client);

    try {
        $calendarId = 'primary';
        $service->events->delete($calendarId, $event_id);
        $_SESSION['message'] = 'Event Deleted Successfully!';
        $_SESSION['msg_type'] = 'success';
    } catch (Exception $e) {
        $_SESSION['message'] = 'failed to delete event.';
        $_SESSION['msg_type'] = 'danger';
    }

    header('Location: events.php');
    exit();


}

