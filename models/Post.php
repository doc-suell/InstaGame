<?php

include_once "../config/database.php";

class Post {
    private ?int $id;
    private int $userId;
    private string $description;
    private string $postPicture;
    private ?string $publicationDate;

    public function __construct(?int $id, int $userId, string $description, string $postPicture, ?string $publicationDate) {
        $this->id = $id;
        $this->userId = $userId;
        $this->description = $description;
        $this->postPicture = $postPicture;
        $this->publicationDate = $publicationDate;
    }


    // SHOW ALL POSTS FUNCTION
    public static function showPosts(Database $db){
        $stmt = $db->getConnection()->query("SELECT * FROM `posts`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // SHOW SINGLE POSTS FUNCTION
    public static function showSinglePost(Database $db, $postId){
        $stmt = $db->getConnection()->prepare("SELECT * FROM `posts` WHERE `id` = :id");
        $stmt->bindParam(":id", $postId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ADD POST FUNCTION
    public  function addPost(Post $post, Database $db){
        $stmt = $db->getConnection()->prepare("INSERT INTO `posts`(`user_id`, `post_picture`, `description`) VALUES (:userId,:postPicture,:description)");
        $userId = $post->getUserId();
        $postPicture = $post->getPostPicture();
        $description = $post->getDescription();
        
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':postPicture', $postPicture);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
    }

    // EDIT POST FUNCTION
    public function updatePost(Database $db){
        $stmt = $db->getConnection()->prepare("UPDATE `posts` SET `post_picture`='[value-3]',`description`='[value-4]',`created_at`='[value-5]' WHERE `posts`.`id` = :id");
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":postPicture", $this->postPicture);
        $stmt->bindParam(":postPicture", $this->description);
        $stmt->bindParam(":postPicture", $this->publicationDate);

        return $stmt->execute();
    }

    // DELETE POST FUNCTION
    public static function deletePost(Database $db, $postId){
        $stmt = $db->getConnection()->prepare("DELETE FROM `posts` WHERE id = :id");
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