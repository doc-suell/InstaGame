<?php
session_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: GET , POST, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: multipart/form-data');


include_once "../models/User.php";


if (isset($_POST['action'])) {
    if ($_POST['action'] == "addMember") {
        $db = new Database();

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email =  $_POST['email'];
        $postPicture = $_FILES['file'];;

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

        // PHOTO 

        if ($postPicture['error'] === UPLOAD_ERR_OK) {
            $uploadDir = "../images/";
            $uploadPath = $uploadDir . $postPicture['name'];
    
                if(move_uploaded_file($postPicture['tmp_name'], $uploadPath)){
                    $postPicturePath = "http://localhost/instaGame/images/" . $postPicture['name'];

                $user = new User(NULL, $username, $email, $password, $postPicturePath, NULL);
                User::addUser($user, $db);

                echo json_encode(["message" => "Utilisateur ajouté avec succès"]);
            } else {
                echo json_encode(["error" => "Error adding user while uploading"]);
            }
        } else {
        }
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
            $db = new Database();
            $userId = $_SESSION['id'];
            $_SESSION['user'] = User::getsById($userId, $db);
            echo json_encode(["user" => $_SESSION['user'], "message" => "Utilisateur connecté "]);
        }
    }
} else {
    echo json_encode(["message" => "Aucune action spécifiée"]);
}
