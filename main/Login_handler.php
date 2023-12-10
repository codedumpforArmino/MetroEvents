<?php
    session_start();
            
    $users = json_decode(file_get_contents('../data/users.json'), true);
    
    $Uname = $_POST['username'];
    $Upass = $_POST['userpassword'];
    $action = $_POST['action'];

    if($action === 'LogIn'){
        $LogInStatus = 0;

        foreach($users as $user){
            if($user['Username'] == $Uname && $user['Userpassword'] == $Upass){
                $_SESSION['UserType']=$user['UserType'];
		        $_SESSION['Username']=$user['Username'];
		        
                $LogInStatus = 1;
                break;
            }
        }

        if($LogInStatus == 0){
            $redirectUrl = "index.php?error=1";
        }else{
            $redirectUrl = "mainpage.php";
        }
    }
    else if($action === 'Register'){
        $redirectUrl = "index.php?success=1";
        $UsersJSON = '../data/users.json';
        $data = json_decode(file_get_contents($UsersJSON), true);
        $UserID = count($data);
        
        $newData = array(
            "UserID" => $UserID + 1, // Assign a new ID (assuming IDs are sequential)
            "Username" => $Uname,
            "Userpassword" => $Upass,
            "UserType" => "regular"
        );
        
        $data[] = $newData;
        
        $updatedJSON = json_encode($data, JSON_PRETTY_PRINT);
        
        if ($updatedJSON === false) {
        echo "Error encoding updated data to JSON";
        exit;
        }
        
        file_put_contents($UsersJSON, $updatedJSON);
    }

    header("Location: $redirectUrl");
    exit();
?>