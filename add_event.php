<?php

use Google\Service\Calendar;
use Google\Service\Calendar\Event;

require './include.main.files.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $summary = $_POST['summary'];
    $description = $_POST['description'];
    $start_datetime = dateTimeFormat($_POST['start_datetime']);
    $end_datetime = dateTimeFormat($_POST['end_datetime']);
    $client = new Google_Client();
    $client->setAuthConfig('./credentials.json');
    $client->addScope(Google_Service_Calendar::CALENDAR);
    $client->setAccessType('offline');
    $client->setAccessToken($_SESSION['access_token']);
    $service = new Calendar($client);

    // Create a new event
    $event = new Event(array(
        'summary' => $summary,
        'location' => '',
        'description' => $description,
        'start' => array(
            'dateTime' => $start_datetime,
            'timeZone' => 'Asia/Kathmandu',
        ),
        'end' => array(
            'dateTime' => $end_datetime,
            'timeZone' => 'Asia/Kathmandu',
        ),
    ));

    try {
        $calendarId = 'primary';
        $event = $service->events->insert($calendarId, $event);
        $_SESSION['message'] = 'Event Added Successfully';
        $_SESSION['msg_type'] = 'success';
        header('Location: index.php');
        exit();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

header('Location: index.php');
exit();


