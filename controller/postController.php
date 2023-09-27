<?php
session_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: GET , POST, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Allow-Credentials: true');

include_once "../config/database.php";
include_once "../models/Post.php";

$db = new Database();


if(isset($_REQUEST['action'] )){
    $action = $_REQUEST['action'];

    if($action == "addPost" && $_SERVER['REQUEST_METHOD'] === 'POST'){
        $postPicture = $_FILES['file'];
        $description = $_POST['description'];
        

        // FILE FILTER ONLY  (JPEG ou JPG)
        $allowedExtensions = array("jpg", "jpeg");
        $fileExtension = strtolower(pathinfo($postPicture['name'], PATHINFO_EXTENSION));
        
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo json_encode(["error" => "Only JPEG or JPG files are allowed."]);
            exit;
        }

        // MAX file  (500 Ko)
        if ($postPicture['size'] > 500 * 1024) {
            echo json_encode(["error" => "The image exceeds the maximum allowed size (500 KB)."]);
            exit;
        }

        // DESCRIPTION MAX CHARACTERS (200 caractères)
        if (strlen($description) > 200) {
            echo json_encode(["error" => "The description must not exceed 200 characters."]);
            exit;
        }

        if($postPicture['error'] === UPLOAD_ERR_OK){
            $uploadDir = "../images/";
            $uploadPath = $uploadDir . $postPicture['name'];

            if(move_uploaded_file($postPicture['tmp_name'], $uploadPath)){
                $postPicturePath = "http://localhost/instaGame/images/" . $postPicture['name'];
                $description = htmlspecialchars($description);
               
                $userId = $_SESSION['id'];
                $post = new Post(null, $userId, $description, $postPicturePath, null);
                $post->addPost($post, $db);
                
  
                echo json_encode(["message" => "Post successfully created"]);
            } else {
                echo json_encode(["error" => "Error creating post while uploading"]);
            }
        } else {
            echo json_encode(["error" => "Error uploading post"]);
        }
    } elseif ($action == "getPosts" && $_SERVER['REQUEST_METHOD'] === 'GET') {

        $posts = Post::showPosts($db);
        
    
        header('Content-Type: application/json');
      
        echo json_encode($posts);
        exit;
    } else {
        echo json_encode(["error" => "Action not allowed"]);
    }
} else {
    echo json_encode(["error" => "Empty Action Request"]);
}

// SUPPRIMER LE POST

if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
    if ($action == "deletePost" && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $postId = $_GET['id'];
        $success = Post::deletePost($postId, $db);
        if ($success) {
            echo json_encode(["message" => "Post successfully deleted"]);
        } else {
            echo json_encode(["error" => "Error deleting post"]);
        }
        exit;
    }
}



// EDIT LE POST



// EDIT LE POST


if(isset($_REQUEST['action'])) {
    parse_str(file_get_contents("php://input"), $putData);
           $postId = $putData['id'];
           $newDescription = $putData['new_description'];
   
           // Check if a new image is provided
           if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
               $newImage = $_FILES['file'];
   
               // FILE FILTER ONLY  (JPEG ou JPG)
               $allowedExtensions = array("jpg", "jpeg");
               $fileExtension = strtolower(pathinfo($newImage['name'], PATHINFO_EXTENSION));
   
               if (!in_array($fileExtension, $allowedExtensions)) {
                   echo json_encode(["error" => "Only JPEG or JPG files are allowed."]);
                   exit;
               }
   
               // MAX file  (500 Ko)
               if ($newImage['size'] > 500 * 1024) {
                   echo json_encode(["error" => "The image exceeds the maximum allowed size (500 KB)."]);
                   exit;
               }
   
               $uploadDir = "../images/";
               $uploadPath = $uploadDir . $newImage['name'];
   
               if (move_uploaded_file($newImage['tmp_name'], $uploadPath)) {
                   $newImagePath = "http://localhost/instaGame/images/" . $newImage['name'];
               } else {
                   echo json_encode(["error" => "Error uploading new image"]);
                   exit;
               }
           }
   
           $success = Post::updatePost($postId, $newDescription, $newImagePath, $db);
   
           if ($success) {
               echo json_encode(["message" => "Post successfully edited"]);
           } else {
               echo json_encode(["error" => "Error editing post"]);
           }
           exit;
   }
   ?>
   
?>
