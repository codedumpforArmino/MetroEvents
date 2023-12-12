<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../style/event.css">
        <?php
            session_start();
            
            $events = json_decode(file_get_contents('../data/events.json'), true);
            $display="";

            foreach($events as $event){
                $display .="<form action='event_action.php' method='post'>
                                    <div class='UniqueEventContainer'>
                                        <div class='EventTitle'>".$event['title']."</div>
                                        <div class='EventBody'>
                                            <div class='Bodytop'>
                                                <div class='Date'> <b>Date: </b>".$event['time']."</div>
                                                <div class='EventDescription'> ".$event['body']."</div>
                                            </div>
                                            <div class='Bodybottom'>
                                                <div class='upvotes'> <b>Upvotes: </b>".$event['upvotes']."</div>
                                                <div class='participants'> <b>Participants: </b> 100</div>
                                                <div class='status'> <b>Status: </b> ".$event['status']."</div>
                                            </div>
                                        </div>
                                        <div class='EventAction'>
                                            <input type='hidden' name='event_id' value='". $event['id'] ."'>
                                            <button class='dltbtn'>Delete Event</button>
                                        </div>
                                        <div class='CommentSection'></div>
                                    </div>
                            </form>";
            }
        ?>
    </head>
    <body>
        <div class="HeaderContainter">
            <h1>WEB DEV: Metro Event</h1>
            <div class="LowerHead">
                <h3 id="CurrentUser">Logged In as <?php echo $_SESSION['Username']; ?></h3>
                <div class="interactables">
                    <button onclick="window.location.href = 'mainpage.php'" id="Home">Home</button>
                    <button id="CreatePost">Notifications</button>
                    <button onclick="window.location.href = 'user_profile.php';" id="dashboard">User</button>
                    <a href = "logout.php">
                    <button id="dashboard">Logout</button>    
                </a>             
                </div>
            </div>
        </div>

        <div class="BodyContainer">
            <div class="EventContainer">
                <div id="DataContainer">

                    <?php echo $display; ?>

                </div>
            </div>

            <div class="sidebarContainer">
            </div>
        </div>
    </body>
</html>