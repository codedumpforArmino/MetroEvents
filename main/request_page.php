<html>
<head>
    <link rel="stylesheet" type="text/css" href="../style/event.css">
    <?php
    include('api.php'); ?>
    </head>
    <body>
        <div class="HeaderContainter">
            <h1>Request Page</h1>
            <div class="LowerHead">
                <h3 id="CurrentUser">Logged In as <?php echo $_COOKIE['Username']; ?></h3>
                <div class="interactables">
                    <button onclick="window.location.href = 'mainpage.php'" id="Home">Home</button>
                    <button id="Dashboard">Request</button>
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