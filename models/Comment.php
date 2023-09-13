<?php

include_once "./config/database.php";

class Comment
{
    function __construct(
        private ?int $id,
        private string $postId,
        private string $userId,
        private string $text,
        private ?string $createdAt
    ) {
    }

    public static function getComments(Database $db)
    {
        $stmt = $db->getConnection()->query("SELECT * FROM `comments`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCommentById(Database $db,$id)
    {
        $stmt = $db->getConnection()->query("SELECT * FROM `comments` WHERE `id` = '$id'");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function createComment(Database $db, $comment)
    {
        $stmt = $db->getConnection()->prepare("INSERT INTO comments (user_id, post_id, comment) VALUES
        (:userId, :postId, :comment)");
        $userId = $comment->getUserId();
        $postId = $comment->getPostId();
        $comment = $comment->getText();

        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':postId', $postId);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();
    }

    public static function deleteComment(Database $db, $comment)
    {
        $stmt = $db->getConnection()->prepare("DELETE FROM comments WHERE id = :id");
        $id = $comment->getId();
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public static function updateComment(Database $db, $comment, $text)
    {
        $stmt = $db->getConnection()->prepare("UPDATE comments SET comment = :comment WHERE id = :id");
        $id = $comment->getId();
        $stmt->bindParam(':comment', $text);
        $stmt->bindParam(':id', $id);
        var_dump($id, $text);

        $stmt->execute();
    }


    // Méthodes getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    // Méthodes setters
    public function setText(string $text)
    {
        $this->text = $text;
    }
}
