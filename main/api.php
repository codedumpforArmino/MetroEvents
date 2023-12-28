<?php
session_start();

function getEventsData() {
    $events = json_decode(file_get_contents('../data/events.json'), true);
    return $events;
}

function saveEventsToFile($events) {
    file_put_contents('../data/events.json', json_encode($events, JSON_PRETTY_PRINT));
}

function saveNotifToFile($notif){
    file_put_contents('../data/notif.json', json_encode($notif, JSON_PRETTY_PRINT));
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


function updateRequestStatus($userId) {
    $users = json_decode(file_get_contents('../data/users.json'), true);

    $users[$userId-1]['UserType'] = 'organizer';
    file_put_contents('../data/users.json', json_encode($users, JSON_PRETTY_PRINT));
    return;
}

function dltRequest($requestId){
    $requests = getRequestsData();

    $dataToDelete = $requests[(int) $requestId];

    if ($dataToDelete) {
        // Find the index of the element to delete
        $indexToDelete = array_search($dataToDelete, $requests, true);

        if ($indexToDelete !== false) {
            array_splice($requests, $indexToDelete, 1); // Remove 1 element at the found index
            saveRequestsToFile($requests);
            return;
        }
    }
    return;
}

function addNotif($requestId, $case){
    $requests = getRequestsData();
    $notifications = getNotificationsData();
    $data = $requests[(int) $requestId];
    $notifID = count($notifications);

    if($data['RequestType'] == 'Join Event' && $case == 'accept'){
        $notifmsg = "Your request to join event has been approved.";
    }

    if($data['RequestType'] == 'Join Event' && $case == 'decline'){
        $notifmsg = "Your request to join event has been declined.";
    }

    if($data['RequestType'] == 'Organizer Request' && $case == 'Approve'){
        $notifmsg = "Your request to join event has been approved.";
        updateRequestStatus($data['UserID']);
        echo "stuff";
    }

    if($data['RequestType'] == 'Organizer Request' && $case == 'Decline'){
        $notifmsg = "Your request to be an organizer has been declined.";
    }

    $newData = array(
        "id" => $notifID+1,
        "UserID" => $data['UserID'],
        "body" => $notifmsg
    );

    $notifications[] = $newData;
    $updatedJSON = json_encode($notifications, JSON_PRETTY_PRINT);
    saveNotifToFile($notifications);
    dltRequest($requestId);
    return;
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['action'])){
        $action = $_POST['action'];
        $request = $_POST['request_id'];

        addNotif($request, $action);
    }

    header("Location: " . $_POST['caller']);
    exit();
}



function deleteNotif($notificationId){
    $notifications = getNotificationsData();

    $indexToDelete = array_search($notificationId, array_column($notifications, 'id'));

    if ($indexToDelete !== false) {
        array_splice($notifications, $indexToDelete, 1);
        saveNotifToFile($notifications);
        header('Location: notification.php');
        return true;
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_notification'])) {
        $notifToDeleteId = $_POST['notification_id'];
        deleteNotif($notifToDeleteId);
        exit();
    }
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reqsub'])) {
        $uid = $_COOKIE['UserID'];
        $uname = $_COOKIE['Username'];
        $type = $_POST['RequestType'];
        $requests = getRequestsData();
        $reqdesc = "Request to be Organizer";


        $maxRequestId = 0;
        foreach ($requests as $request) {
            $maxRequestId = max($maxRequestId, $request['id']);
        }

        

        $newRequest = [
            'UserID' => (int) $uid,
            'Username' => $uname,
            'RequestType' => $type,
            'RequestDesc' => $reqdesc,
            'EventId' => 0,
        ];

        $requests[] = $newRequest;
        saveRequestsToFile($requests);
        header('Location: request_page.php');
        exit();
    } elseif (isset($_POST['other_action'])) {

    }
}

?>
