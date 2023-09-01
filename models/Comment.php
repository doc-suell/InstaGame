<?php 
class Comment {
    private int $id;
    private int $postId;
    private int $userId;
    private string $text;
    private string $createdAt;

    public function __construct(int $postId, int $userId, string $text) {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->text = $text;
        $this->createdAt = date('Y-m-d H:i:s');
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

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    // Méthodes setters
    public function setText(string $text) {
        $this->text = $text;
    }
}