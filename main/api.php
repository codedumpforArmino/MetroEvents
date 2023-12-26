<?php
session_start();

function getEventsData() {
    $events = json_decode(file_get_contents('../data/events.json'), true);
    return $events;
}

function saveEventsToFile($events) {
    file_put_contents('../data/events.json', json_encode($events, JSON_PRETTY_PRINT));
}

function getRequestsData() {
    $requests = json_decode(file_get_contents('../data/request.json'), true);
    return $requests;
}

function saveRequestsToFile($requests) {
    file_put_contents('../data/request.json', json_encode($requests, JSON_PRETTY_PRINT));
}

function getNotificationsData() {
    $notifications = json_decode(file_get_contents('../data/notif.json'), true);
    if ($notifications === null) {
        // Handle the case where decoding fails, e.g., return an empty array
        return [];
    }

    return $notifications;
}

function deleteNotif(){

}

function deleteEvent($eventId) {
    $events = getEventsData();

    $indexToDelete = array_search($eventId, array_column($events, 'id'));

    if ($indexToDelete !== false) {
        array_splice($events, $indexToDelete, 1);
        saveEventsToFile($events);
        return true;
    }

    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $eventToDeleteId = $_POST['event_id'];
        deleteEvent($eventToDeleteId);
        header('Location: admin_dash.php');
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reqsub'])) {
    $uid = $_COOKIE['UserID'];
    $uname = $_COOKIE['Username'];
    $type = $_POST['RequestType'];
    $reqdesc = $_POST['RequestDesc'];
    $requests = getRequestsData();

    $maxRequestId = 0;
    foreach ($requests as $request) {
        $maxRequestId = max($maxRequestId, $request['id']);
    }

    $newRequest = [
        'UserID' => $uid,
        'Username' => $uname,
        'RequestType' => $type,
        'RequestDesc' => $reqdesc,
        'EventId' => 0,
    ];

    $requests[] = $newRequest;
    saveRequestsToFile($requests);

    // Redirect to the same page after submitting the request
    header('Location: request_page.php');
    exit();
}
?>
