<?php


namespace App\Repositories;

use PDO;
use App\Models\Comment;

class CommentRepository extends BaseRepository
{



    public function findByPostID($postId): array
    {

        $pdo = $this->db->getPDO();

        $query = $pdo->prepare('SELECT * FROM comment WHERE postId=:postId ORDER BY createdAt DESC');

        $query->setFetchMode(PDO::FETCH_CLASS, Comment::class, [$this->db]);

        $query->execute(['postId' => $postId]);

        return $query->fetchAll();
    }

    public function create(Comment $comment): void
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("INSERT INTO comment (author,content,postId) VALUES (:author, :content, :postId)");
        $query->execute([
            "author"    => $comment->getAuthor(),
            "content"   => $comment->getContent(),
            "postId"    => $comment->getId()
        ]);
    }
}
