<html>
<head>
    <link rel="stylesheet" type="text/css" href="../style/event.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php
    include('api.php');
    ?>
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
                <a href="logout.php">
                    <button id="dashboard">Logout</button>
                </a>
            </div>
        </div>
    </div>

    <form action="api.php" method="post">
        <div class="form-group">
            <label for="type">Request Type</label>
            <input class="form-control" type="text" name="RequestType" placeholder="Default input">
            <label for="desc">Request Description</label>
            <textarea class="form-control" id="desc" name="RequestDesc" rows="3"></textarea>
            <button class="btn btn-primary" type="submit" name="reqsub">Submit</button>
        </div>
    </form>

    <div class="sidebarContainer">
    </div>
</body>
</html>
