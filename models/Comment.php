<?php 

include_once "./config/database.php";

class Comment {

    function __construct(
        private ?int $id,
        private string $postId,
        private string $userId,
        private string $text,
        private ?string $createdAt
        )
        {}

    public static function getComments(){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query("SELECT * FROM `comments`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCommentById($id){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query("SELECT * FROM `comments` WHERE `id` = '$id'");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function createComment($comment){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO comments (user_id, post_id, comment) VALUES
        (:userId, :postId, :comment)");
        $userId = $comment->getUserId();
        $postId = $comment->getPostId();
        $comment = $comment->getText();

        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':postId', $postId);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();
    }

    public static function deleteComment($comment){
        $db = new Database();
        $conn = $db->getConnection();
        $query = $conn->prepare("DELETE FROM comments WHERE id = :id");
        $id = $comment->getId();
        $query->bindParam(':id', $id);
        $query->execute();
    }

    public static function updateComment($comment, $text){
        $db = new Database();
        $conn = $db->getConnection();
        $query = $conn->prepare("UPDATE comments SET comment = :comment WHERE id = :id");
        $id = $comment->getId();
        $query->bindParam(':comment', $text);
        $query->bindParam(':id', $id);
        var_dump($id, $text);

        $query->execute();
    }


    // Méthodes getters
    public function getId(): int {
        return $this->id;
    }

    public function getPostId(): int {
        return $this->postId;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function getText(): string {
        return $this->text;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    // Méthodes setters
    public function setText(string $text) {
        $this->text = $text;
    }
}