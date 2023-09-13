<?php

include_once "./config/database.php";

class Post {
    private ?int $id;
    private int $userId;
    private string $description;
    private string $postPicture;
    private string $publicationDate;

    public function __construct(?int $id, int $userId, string $description, string $postPicture, string $publicationDate) {
        $this->id = $id;
        $this->userId = $userId;
        $this->description = $description;
        $this->postPicture = $postPicture;
        $this->publicationDate = $publicationDate;
    }


    // SHOW ALL POSTS FUNCTION
    public static function showPosts(){
        $instance = Database::getInstance();
        $conn = $instance->getConnection();
        $stmt = $conn->query("SELECT * FROM `posts`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

<<<<<<< HEAD
=======

    // SHOW SINGLE POSTS FUNCTION
    public static function getPostById($postId){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM `posts` WHERE id = :id ");
        $stmt->bindParam(":id", $postId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);


    }

>>>>>>> 4038c8289310838ebfbe9dd5a74aa7fa32edc246

    // ADD POST FUNCTION
    public  function addPost(){
        $instance = Database::getInstance();
        $conn = $instance->getConnection();
        $stmt = $conn->prepare("INSERT INTO `posts`(`id`, `user_id`, `post_picture`, `description`, `created_at`) VALUES (NULL,1,:postPicture,:description,:publicationDate)");
        $stmt->bindParam(":postPicture", $this->postPicture);
        $stmt->bindParam(":postPicture", $this->description);
        $stmt->bindParam(":postPicture", $this->publicationDate);
        
        return $stmt->execute();
    }

    // EDIT POST FUNCTION
    public function updatePost(){
<<<<<<< HEAD
        $instance = Database::getInstance();
        $conn = $instance->getConnection();
        $stmt = $conn->prepare("UPDATE `posts` SET `post_picture`='[value-3]',`description`='[value-4]',`created_at`='[value-5]' WHERE `posts`.`id` = :id");
=======
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE `posts` SET `post_picture`= :postPicture,`description`=:description,`created_at`= :publicationDate WHERE `posts`.`id` = :id");
>>>>>>> 4038c8289310838ebfbe9dd5a74aa7fa32edc246
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":postPicture", $this->postPicture);
        $stmt->bindParam(":postPicture", $this->description);
        $stmt->bindParam(":postPicture", $this->publicationDate);

        return $stmt->execute();
    }

    
    // DELETE POST FUNCTION
    public static function deletePost($postId){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM `posts` WHERE id = :id");
        $stmt->bindParam(":id", $postId);
        return $stmt->execute();
    }




<<<<<<< HEAD
=======





>>>>>>> 4038c8289310838ebfbe9dd5a74aa7fa32edc246
    // Méthodes getters
    public function getId(): int {
        return $this->id;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getPostPicture(): string {
        return $this->postPicture;
    }

    public function getPublicationDate(): string {
        return $this->publicationDate;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function setPostPicture(string $postPicture) {
        $this->postPicture = $postPicture;
    }

    public function setPublicationDate(string $publicationDate) {
        $this->publicationDate = $publicationDate;
    }
    }