<?php

include_once "../config/database.php";

class Comment
{
    private ?int $id;
    private int $postId;
    private string $userId;
    private string $text;
    private ?string $createdAt;

    public function __construct(
        ?int $id,
        int $postId,
        string $userId,
        string $text,
        ?string $createdAt
    ) {
        $this->id = $id;
        $this->postId = $postId;
        $this->userId = $userId;
        $this->text = $text;
        $this->createdAt = $createdAt;
    }

    public static function getComments(Database $db)
    {
        $stmt = $db->getConnection()->query("SELECT * FROM `comments`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCommentsForPost(Database $db, int $postId)
    {
        $stmt = $db->getConnection()->prepare('SELECT comment FROM comments WHERE post_id = ?');
        $stmt->execute([$postId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getUserIdForComment(Database $db, int $commentId)
{
    $stmt = $db->getConnection()->prepare('SELECT user_id FROM comments WHERE id = :commentId');
    $stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && isset($result['user_id'])) {
        return $result['user_id'];
    } else {
        return null; // Commentaire non trouvé ou user_id non défini
    }
}

    public static function getCommentById(Database $db, $id)
    {
        $stmt = $db->getConnection()->prepare("SELECT * FROM `comments` WHERE `id` = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getCommentsByPostId(Database $db, $postId)
    {
        $stmt = $db->getConnection()->prepare("SELECT * FROM `comments` WHERE `post_id` = :postId");
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function createComment(Database $db, Comment $comment)
    {
        $stmt = $db->getConnection()->prepare("INSERT INTO comments (user_id, post_id, comment) VALUES (:userId, :postId, :comment)");
        $userId = $comment->getUserId();
        $postId = $comment->getPostId();
        $commentText = $comment->getText();

        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':postId', $postId);
        $stmt->bindParam(':comment', $commentText);
        $stmt->execute();
    }

    public static function deleteComment(Database $db, $id)
    {
        $stmt = $db->getConnection()->prepare("DELETE FROM comments WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function updateComment(Database $db, $comment, $text)
    {
        $stmt = $db->getConnection()->prepare("UPDATE comments SET comment = :comment WHERE id = :id");
        $id = $comment->getId();
        $stmt->bindParam(':comment', $text);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function getUsernameForComment(Database $db, int $commentId)
{
    $stmt = $db->getConnection()->prepare('SELECT u.username FROM comments c INNER JOIN users u ON c.user_id = u.id WHERE c.id = :commentId');
    $stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && isset($result['username'])) {
        return $result['username'];
    } else {
        return null; // Commentaire non trouvé ou nom d'utilisateur non défini
    }
}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostId(): string
    {
        return $this->postId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }
}
