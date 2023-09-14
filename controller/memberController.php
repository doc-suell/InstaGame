<?php 

include_once "../models/User.php";








if(isset($_POST['action'])){
    if($_POST['action'] == "addMember"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        
        $user = new User(NULL, $username,  $email,  $password,  $profilePicture, $db);

        User::addUser($username,  $email,  $password, $db);
        
    }else{
        echo "rien";
    }
} else{
    echo "rien 2";
}


?>

