<?php 

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET , POST, PUT, DELETE, OPTIONS');;
header("Access-Control-Allow-Headers: X-Requested-With");
header("Access-Control-Allow-Headers: Content-Type");





include_once "../models/User.php";

if(isset($_POST['action'])){
    if($_POST['action'] == "addMember"){

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email =  $_POST['email'];

        $user = new User(NULL, $username, $email, $password, $profilePicture, $db);
        User::addUser($username, $email, $password, $db);

        // Réponse JSON de succès (ou tout autre message)
        echo json_encode(["message" => "Utilisateur ajouté avec succès"]);
    } else {
        echo json_encode(["message" => "Action non reconnue"]);
    }
} else {
    echo json_encode(["message" => "Aucune action spécifiée"]);
}
?>