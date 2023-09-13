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
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query("SELECT * FROM `posts`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // SHOW SINGLE POSTS FUNCTION
    public static function getPostById($postId){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM `posts` WHERE id = :id ");
        $stmt->bindParam(":id", $postId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);


    }


    // ADD POST FUNCTION
    public  function addPost(){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO `posts`(`id`, `user_id`, `post_picture`, `description`, `created_at`) VALUES (NULL,1,:postPicture,:description,:publicationDate)");
        $stmt->bindParam(":postPicture", $this->postPicture);
        $stmt->bindParam(":postPicture", $this->description);
        $stmt->bindParam(":postPicture", $this->publicationDate);
        
        return $stmt->execute();
    }

    // EDIT POST FUNCTION
    public function updatePost(){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE `posts` SET `post_picture`= :postPicture,`description`=:description,`created_at`= :publicationDate WHERE `posts`.`id` = :id");
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