<?php
session_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');

include_once "../config/database.php";
include_once "../models/Comment.php";

$db = new Database();

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];

    if ($action == "addComment" && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $postId = $_POST['post_id'];
        $userId = $_SESSION['id'];
        $text = $_POST['comment'];



        // Validation du texte du commentaire, vous pouvez ajouter des validations supplémentaires si nécessaire
        if (strlen($text) > 200) {
            echo json_encode(["error" => "The comment text must not exceed 200 characters."]);
            exit;
        }

        $comment = new Comment(null, $postId, $userId, $text, null);
        Comment::createComment($db, $comment);

        echo json_encode(["message" => "Comment successfully created"]);
    } elseif ($action == "getComments" && $_SERVER['REQUEST_METHOD'] === 'GET') {
        $comments = Comment::getComments($db);

        header('Content-Type: application/json');
        echo json_encode($comments);
        exit;
    } elseif ($action == "getCommentsByPostId" && $_SERVER['REQUEST_METHOD'] === 'GET') {
        $postId = $_GET['post_id'];
        $comments = Comment::getCommentsByPostId($db, $postId);
        // var_dump($postId);

        echo json_encode($comments);
        exit;
    } elseif ($action == "deleteComment" && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $commentId = $_GET['id'];
        $success = Comment::deleteComment($db, $commentId);
        var_dump($success);
        if ($success) {
            echo json_encode(["message" => "Comment successfully deleted"]);
        } else {
            echo json_encode(["error" => "Error deleting comment"]);
        }
        exit;
    } elseif ($action == "editComment" && $_SERVER['REQUEST_METHOD'] === 'PUT') {
        parse_str(file_get_contents("php://input"), $putData);
        $commentId = $putData['id'];
        $newText = $putData['new_text'];

        // Validation du nouveau texte du commentaire, vous pouvez ajouter des validations supplémentaires si nécessaire
        if (strlen($newText) > 200) {
            echo json_encode(["error" => "The comment text must not exceed 200 characters."]);
            exit;
        }

        $success = Comment::updateComment($db, $commentId, $newText);

        if ($success) {
            echo json_encode(["message" => "Comment successfully edited"]);
        } else {
            echo json_encode(["error" => "Error editing comment"]);
        }
        exit;
    } else if ($action == "getUserInfo" && $_SERVER['REQUEST_METHOD'] === 'GET') {
        // Récupérez les informations de l'utilisateur connecté depuis la session ou d'où elles sont stockées
        $userInfo = [
            "id" => $_SESSION['id'],
            "username" => $_SESSION['user'],

            // Autres informations de l'utilisateur
        ];

        header('Content-Type: application/json');
        echo json_encode($userInfo);
        exit;
    } elseif ($action == "getUsernameForComment" && $_SERVER['REQUEST_METHOD'] === 'GET') {
        $commentId = $_GET['commentId'];
        $username = Comment::getUsernameForComment($db, $commentId);

        header('Content-Type: application/json');
        echo json_encode(["username" => $username]);
        exit;
    } else if ($action == "deleteComment" && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $commentId = $_GET['id'];
        $comment = Comment::getCommentById($db, $commentId);
        if ($comment && $comment['user_id'] === $_SESSION['id']) {
            $success = Comment::deleteComment($db, $commentId);

            if ($success) {
                echo json_encode(["message" => "Comment successfully deleted"]);
            } else {
                echo json_encode(["error" => "Error deleting comment"]);
            }
        } else {
            echo json_encode(["error" => "You are not authorized to delete this comment"]);
        }
        exit;
    } else {
        echo json_encode(["error" => "Action not allowed"]);
    }
} else {
    echo json_encode(["error" => "Empty Action Request"]);
}