<?php


namespace App\Repositories;

use PDO;
use App\Models\Comment;

class CommentRepository extends BaseRepository
{

    protected $table = "comment";
    protected $class = Comment::class;

    public function findValidatedByPostID($postId): array
    {

        $pdo = $this->db->getPDO();

        $query = $pdo->prepare('SELECT * FROM comment WHERE postId=:postId AND validated = 1 ORDER BY createdAt DESC');

        $query->setFetchMode(PDO::FETCH_CLASS, Comment::class, [$this->db]);

        $query->execute(['postId' => $postId]);

        return $query->fetchAll();
    }

    public function allNotValidated()
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->query("SELECT p.author as postAuthor,p.title,c.author,c.id,c.content 
                              FROM `comment` AS c 
                              JOIN post as p ON c.postId = p.id 
                              WHERE NOT c.validated 
                              ORDER BY `c`.`id` ASC");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        return $query->fetchAll();
    }


    public function create(Comment $comment): void
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("INSERT INTO comment (author,content,postId) VALUES (:author, :content, :postId)");
        $query->execute([
            "author"    => $comment->getAuthor(),
            "content"   => $comment->getContent(),
            "postId"    => $comment->getPostId()
        ]);
    }
}