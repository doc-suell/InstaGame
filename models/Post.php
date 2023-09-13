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

<<<<<<< HEAD

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
        $stmt = $conn->prepare("UPDATE `posts` SET `post_picture`='[value-3]',`description`='[value-4]',`created_at`='[value-5]' WHERE `posts`.`id` = :id");
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":postPicture", $this->postPicture);
        $stmt->bindParam(":postPicture", $this->description);
        $stmt->bindParam(":postPicture", $this->publicationDate);
        
        return $stmt->execute();
    }




=======
>>>>>>> 2a2c7a10dd10656d8b00de9fc891fd9d133572f4
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