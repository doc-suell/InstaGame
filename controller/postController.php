<?php 

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET , POST, PUT, DELETE, OPTIONS');;
header("Access-Control-Allow-Headers: X-Requested-With");
header("Access-Control-Allow-Headers: Content-Type");
include_once "../config/database.php";
include_once "../models/Post.php";


$db = new Database();


if(isset($_POST['action'])){
    if($_POST['action'] == "addPost"){
        $postPicture = $_POST['postPicture'];
        $description = $_POST['description'];
        $user_id =  $_POST['user_id'];

        $post = new Post(null, $user_id, $description, $postPicture, null);
        $post->addPost($post, $db);

        // Réponse JSON de succès (ou tout autre message)
        echo json_encode(["message" => "Post ajouté avec succès"]);
    } else {
        echo json_encode(["message" => "Action non reconnue"]);
    }
    if($_POST["action"] == "getPosts") {

        $posts = Post::showPosts($db);
        // Répondez avec les données au format JSON
        header('Content-Type: application/json');
        echo json_encode($posts);
        exit;
    }else{
        echo "Action non reconue";
    }
} else {
    echo json_encode(["message" => "Aucune action spécifiée"]);
}
?>