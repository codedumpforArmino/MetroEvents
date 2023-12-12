<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit();
}

// Read JSON file
$jsonData = file_get_contents('users.json');
$users = json_decode($jsonData, true);

// Find the logged-in user based on UserID
$loggedInUser = null;
foreach ($users as $user) {
    if ($user['UserID'] == $_SESSION['UserID']) {
        $loggedInUser = $user;
        break;
    }
}

// Check if the user was found
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

<!-- Add any other user information you want to display -->

</body>
</html>
