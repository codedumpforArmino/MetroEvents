<?php
    session_start();
            
    $events = json_decode(file_get_contents('../data/events.json'), true);
    $eventId = $_POST['event_id'];
    $action = $_POST['action'];
    $redirectUrl = "mainpage.php"; // Replace with your HTML page URL

    if($action === 'upvote'){
        foreach($events as $index => $event){
            if ($event['id'] == $eventId) {
                $events[$index]['upvotes']++;
                break;
            }
        }
        file_put_contents('../data/events.json', json_encode($events, JSON_PRETTY_PRINT));
    }

    header("Location: $redirectUrl");
?>