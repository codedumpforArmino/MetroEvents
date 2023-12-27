<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Request</title>
    <link rel="stylesheet" type="text/css" href="../style/event.css">
    <?php
    include('api.php');

    $requests = getRequestsData();
    $display = "";

    foreach ($requests as $request) {
        $display .= "<form action='api.php' method='post'>
                        <div class='UniqueEventContainer'>
                            <h4>" . $request['RequestType'] . "</h4>
                            <h3>" . $request['RequestDesc'] . " </h3>
                            <div class='EventAction'>
                                <input type='hidden' name='request_id' value='" . $request['UserID'] . "'>
                                <input type='hidden' name='action' value='accept'>
                                <button type='submit' class='Joinbtn'>Accept</button>
                            </div>
                            <div class='EventAction'>
                                <input type='hidden' name='request_id' value='" . $request['UserID'] . "'>
                                <input type='hidden' name='action' value='decline'>
                                <button type='submit' class='Joinbtn'>Decline</button>
                            </div>
                        </div>
                    </form>";
    }
    ?>
</head>
<body>
    <div class="HeaderContainter">
        <h1>Participant Request</h1>
        <div class="LowerHead">
            <h3 id="CurrentUser">Logged In as <?php echo $_COOKIE['Username']; ?></h3>
            <div class="interactables">
                <button onclick="window.location.href = 'mainpage.php'" id="Home">Home</button>
                <a href="request_page.php">
                    <button id="dashboard">Request</button>
                </a>
                <a href="notification.php">
                    <button id="dashboard">Notifications</button>
                </a>
                <button onclick="window.location.href = 'index.php';" id="dashboard">Logout</button>
            </div>
        </div>
    </div>
    <div class="BodyContainer">
        <div class="EventContainer">
            <div id="DataContainer">
                <?php echo $display; ?>
            </div>
        </div>
        <div class="sidebarContainer"></div>
    </div>
</body>
</html>
