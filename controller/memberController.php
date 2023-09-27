<?php
session_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: GET , POST, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Allow-Credentials: true');


include_once "../models/User.php";

if (isset($_POST['action'])) {
    if ($_POST['action'] == "addMember") {
        $db = new Database();

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email =  $_POST['email'];


        // Vérifier si le nom d'utilisateur existe déjà
        if (User::usernameExists($username, $db)) {
            echo json_encode(["message" => "Ce nom d'utilisateur existe déjà"]);
            return; // Arrêtez l'exécution ici pour éviter l'ajout de l'utilisateur en double
        }

        // Vérifier si l'e-mail existe déjà
        if (User::emailExists($email, $db)) {
            echo json_encode(["message" => "Cette adresse email existe déjà"]);
            return; // Arrêtez l'exécution ici pour éviter l'ajout de l'utilisateur en double
        }

        // Si ni le nom d'utilisateur ni l'e-mail n'existe, ajoutez l'utilisateur
        $user = new User(NULL, $username, $email, $password, NULL, NULL);
        User::addUser($username, $email, $password, $db);
        echo json_encode(["message" => "Utilisateur ajouté avec succès"]);
    } else if ($_POST['action'] == "login") {
        $db = new Database();

        $username = $_POST['username'];
        $password = $_POST['password'];
        $userId = User::login($username, $password, $db);

        if ($userId !== false) {
            $_SESSION['id'] = $userId; // Enregistrez l'ID de l'utilisateur dans la session
            $_SESSION['user'] = $username;
            echo json_encode(["id" => $userId, "message" => "Utilisateur connecté avec succès"]);
        }
    } else if ($_POST['action'] == "checkConnection") {
        if ($_SESSION['id'] == "") {
            echo json_encode(["message" => "Session vide"]);
        } else {
            $userId = $_SESSION['id'];
            echo json_encode(["id" => $userId, "message" => "Utilisateur connecté "]);
        }
    }
} else {
    echo json_encode(["message" => "Aucune action spécifiée"]);
}
