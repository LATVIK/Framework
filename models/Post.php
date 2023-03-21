<?php

namespace models;

class Post extends BaseModel
{
    protected string $title;
    protected string $text;
    protected string $createdDt;
    protected int $authorId;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getCreatedDt(): string
    {
        return $this->createdDt;
    }

    public function setCreatedDt(string $createdDt): void
    {
        $this->createdDt = $createdDt;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    public function getAuthor(): User
    {
        return User::findById($this->authorId);
    }

    public static function getTableName(): string
    {
        return 'posts';
    }

    public static function findByAuthor(int $authorId): ?array
    {
        return Post::findByColumn('author_id', $authorId);
    }
}
