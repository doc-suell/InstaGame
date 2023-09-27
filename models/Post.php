<?php

include_once "../config/database.php";

class Post
{
    private ?int $id;
    private int $userId;
    private string $description;
    private string $postPicture;
    private ?string $publicationDate;

    public function __construct(?int $id, int $userId, string $description, string $postPicture, ?string $publicationDate)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->description = $description;
        $this->postPicture = $postPicture;
        $this->publicationDate = $publicationDate;
    }


    // SHOW ALL POSTS FUNCTION
    public static function showPosts(Database $db)
    {
        $stmt = $db->getConnection()->query("SELECT posts.*, users.username FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // SHOW ALL POSTS FROM 1 USER FUNCTION
    public static function showPostsByUserId(int $id, Database $db)
    {
        $stmt = $db->getConnection()->query("SELECT * FROM posts WHERE user_id = {$id} ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // SHOW SINGLE POSTS FUNCTION
    public static function showSinglePost(Database $db, $postId)
    {
        $stmt = $db->getConnection()->prepare("SELECT * FROM `posts` WHERE `id` = :id");
        $stmt->bindParam(":id", $postId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ADD POST FUNCTION
    public  function addPost(Post $post, Database $db)
    {
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
    public static function updatePost($postId, $postPicture, $description, Database $db)
    {
        $stmt = $db->getConnection()->prepare("UPDATE `posts` SET `post_picture` = :postPicture, `description` = :description WHERE `posts`.`id` = :id");
        $stmt->bindParam(":id", $postId);
        $stmt->bindParam(":postPicture", $postPicture);
        $stmt->bindParam(":description", $description);

        return $stmt->execute();
    }

    // DELETE POST FUNCTION
    public static function deletePost($postId, Database $db)
    {
        $stmt = $db->getConnection()->prepare("DELETE FROM `posts` WHERE id = :id");
        $stmt->bindParam(":id", $postId);
        return $stmt->execute();
    }




    // Méthodes getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPostPicture(): string
    {
        return $this->postPicture;
    }

    public function getPublicationDate(): string
    {
        return $this->publicationDate;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function setPostPicture(string $postPicture)
    {
        $this->postPicture = $postPicture;
    }

    public function setPublicationDate(string $publicationDate)
    {
        $this->publicationDate = $publicationDate;
    }
}
