<?php

include_once "../../config/database.php";

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


    public static function showPosts(){
        $db = new Database();
        $conn = $db->getConnection();
        $stmt = $conn->query("SELECT * FROM `posts`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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