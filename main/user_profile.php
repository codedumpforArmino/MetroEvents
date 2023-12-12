<?php
session_start();


if (!isset($_SESSION['UserID'])) {
  
    header('Location: login.php');
    exit();
}


$jsonData = file_get_contents('users.json');
$users = json_decode($jsonData, true);


$loggedInUser = null;
foreach ($users as $user) {
    if ($user['UserID'] == $_SESSION['UserID']) {
        $loggedInUser = $user;
        break;
    }
}


if ($loggedInUser === null) {
    echo "Error: User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2, p {
            margin: 10px 0;
        }
    </style>
</head>
<body>

<h2>User Profile</h2>
<p>User ID: <?php echo $loggedInUser['UserID']; ?></p>
<p>Username: <?php echo $loggedInUser['Username']; ?></p>
<p>User Type: <?php echo $loggedInUser['UserType']; ?></p>


</body>
</html>
