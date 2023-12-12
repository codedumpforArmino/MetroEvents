<?php
session_start();

function getEventsData() {
    $events = json_decode(file_get_contents('../data/events.json'), true);
    return $events;
}

function saveEventsToFile($events) {
    file_put_contents('../data/events.json', json_encode($events, JSON_PRETTY_PRINT));
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
?>
