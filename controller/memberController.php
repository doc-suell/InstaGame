<?php

session_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET , POST, PUT, DELETE, OPTIONS');;
header("Access-Control-Allow-Headers: X-Requested-With");
header("Access-Control-Allow-Headers: Content-Type");


include_once "../models/User.php";

if(isset($_POST['action'])){
    if($_POST['action'] == "addMember"){
        $db = new Database();

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email =  $_POST['email'];

        $user = new User(NULL, $username, $email, $password, NULL, NULL);
        User::addUser($username, $email, $password, $db);

        echo json_encode(["message" => "Utilisateur ajouté avec succès"]);
    } else if ($_POST['action'] == "login") {
        $db = new Database();

        $username = $_POST['username'];
        $password = $_POST['password'];
        if(User::login($username, $password, $db)) {
            $_SESSION['user'] = $username;
        }

    }
    else {
        echo json_encode(["message" => "Action non reconnue"]);
    }
} else {
    echo json_encode(["message" => "Aucune action spécifiée"]);
}
?>