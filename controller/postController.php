<?php 

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET , POST, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Access-Control-Allow-Headers: Content-Type");

include_once "../config/database.php";
include_once "../models/Post.php";

$db = new Database();

if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];

    if($action == "addPost" && $_SERVER['REQUEST_METHOD'] === 'POST'){
        $postPicture = $_POST['postPicture'];
        $description = $_POST['description'];
        $user_id =  $_POST['user_id'];

        $post = new Post(null, $user_id, $description, $postPicture, null);
        $post->addPost($post, $db);

        // Réponse JSON de succès (ou tout autre message)
        echo json_encode(["message" => "Post ajouté avec succès"]);
    } elseif ($action == "getPosts" && $_SERVER['REQUEST_METHOD'] === 'GET') {
        $posts = Post::showPosts($db);
        // Répondez avec les données au format JSON
        header('Content-Type: application/json');
        echo json_encode($posts);
        exit;
    } else {
        echo json_encode(["message" => "Action non reconnue"]);
    }
} else {
    echo json_encode(["message" => "Aucune action spécifiée"]);
}
?>
