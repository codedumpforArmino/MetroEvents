<?php
    session_start();
            
    $eventsJSON = '../data/events.json';
    $events = json_decode(file_get_contents($eventsJSON), true);
    $action = $_POST['action'];
    $redirectUrl = "mainpage.php"; // Replace with your HTML page URL

    //function to upvote
    if($action === 'upvote'){
        $eventId = $_POST['event_id'];
        foreach($events as $index => $event){
            if ($event['id'] == $eventId) {
                $events[$index]['upvotes']++;
                break;
            }
        }
        file_put_contents('../data/events.json', json_encode($events, JSON_PRETTY_PRINT));
    }

    //function to add new event
    if($action === 'createEvent'){
        $redirectUrl = "mainpage.php?success=1";
        $eventID = count($events);
        
        $newData = array(
            "OrganizerId"=> $_COOKIE['UserID'],
            "id" => $eventID+1,
            "title" => $_POST['eventTitle'],
            "body" => $_POST['eventDescription'],
            "upvotes" => 0,
            "time" => $_POST['eventTime'],
            "status" => "ongoing"
        );

        $events[] = $newData;

        $updatedJSON = json_encode($events, JSON_PRETTY_PRINT);

        if ($updatedJSON === false) {
            echo "Error encoding updated data to JSON";
            exit;
        }
            
        file_put_contents($eventsJSON, $updatedJSON);
    }

    if($action === 'joinEvent'){
        $redirectUrl = "mainpage.php?success=2";
        $requestsJSON = '../data/request.json';
        $requests = json_decode(file_get_contents($requestsJSON), true);

        $newData = array(
            "UserID" => $_COOKIE['UserID'],
            "Username" => $_COOKIE['Username'],
            "RequestType" => "Join Event",
            "RequestDesc" => "Interested to join Event",
            "EventId" => $_POST['event_id']
        );

        $requests[] = $newData;

        $updatedJSON = json_encode($requests, JSON_PRETTY_PRINT);

        if ($updatedJSON === false) {
            echo "Error encoding updated data to JSON";
            exit;
        }
            
        file_put_contents($requestsJSON, $updatedJSON);
    }

    header("Location: $redirectUrl");
?>