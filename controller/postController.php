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
        $postPicture = $_FILES['file']; 
        $description = $_POST['description'];

        if($postPicture['error'] === UPLOAD_ERR_OK){
            $uploadDir = "../images/";
            $uploadPath = $uploadDir . $postPicture['name'];

            if(move_uploaded_file($postPicture['tmp_name'], $uploadPath)){
                $postPicturePath = "images/" . $postPicture['name'];
                $description = htmlspecialchars($description);

                $post = new Post(null, 1, $description, $postPicturePath, null);
                $post->addPost($post, $db);

                echo json_encode(["message" => "Post successfully created"]);
            } else {
                echo json_encode(["message" => "Error creating post while uploading"]);
            }
        } else {
            echo json_encode(["message" => "Error uploading post"]);
        }
    } elseif ($action == "getPosts" && $_SERVER['REQUEST_METHOD'] === 'GET') {
        $posts = Post::showPosts($db);
        header('Content-Type: application/json');
        echo json_encode($posts);
        exit;
    } else {
        echo json_encode(["message" => "Action not allowed"]);
    }
} else {
    echo json_encode(["message" => "Empty Action Request"]);
}
?>



