<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>

<?php

$jsonData = file_get_contents('path/to/your/json/file.json');
$userData = json_decode($jsonData, true);


if ($userData === null) {
    echo "Error decoding JSON";
} else {
   
    foreach ($userData as $user) {
        echo "<h2>User Profile</h2>";
        echo "<p>User ID: " . $user['UserID'] . "</p>";
        echo "<p>Username: " . $user['Username'] . "</p>";
        echo "<p>User Type: " . $user['UserType'] . "</p>";
       
    }
}
?>

</body>
</html>
