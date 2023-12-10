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
                                            <div class='upvotes'>".$event['upvotes']."</div>
                                            <div class='participants'>100</div>
                                        </div>
                                        <div class='EventAction'>
                                            <input type='hidden' name='event_id' value='". $event['id'] ."'>
                                            <button type='submit' name='action' value='upvote' class='Upvotebtn'>Upvote</button>
                                            <button class='Joinbtn'>Join Event</button>
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
                    <button onclick="window.location.href = 'index.php'" id="Home">Home</button>
                    <button id="CreatePost">Notifications</button>
                    <button id="dashboard">User</button>
                </div>
            </div>
        </div>

        <div class="BodyContainer">
            <div class="EventContainer">
                <div id="DataContainer">

                    <div class="UniqueEventContainer">
                        <div class="EventTitle">Sample Title</div>
                        <div class="EventBody"></div>
                        <div class="CommentSection"></div>
                    </div>

                    <?php echo $display; ?>

                </div>
                <div id="PageCounter">
                    <button id="prevButton"><</button>
                    <h4 id="Pcounter">1</h4>
                    <button id="nextButton">></button>
                </div>
            </div>

            <div class="sidebarContainer">
            </div>
        </div>
    </body>
</html>