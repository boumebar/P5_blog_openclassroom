<?php


namespace App\Repositories;

use PDO;
use App\Models\Comment;

class CommentRepository extends BaseRepository
{

    protected $table = "comment";
    protected $class = Comment::class;

    // Trouve tout les commentaires validés par article 

    public function findValidatedByPostID(int $postId): array
    {

        $pdo = $this->db->getPDO();

        $query = $pdo->prepare('SELECT * FROM comment WHERE postId=:postId AND validated = 1 ORDER BY createdAt DESC');

        $query->setFetchMode(PDO::FETCH_CLASS, Comment::class, [$this->db]);

        $query->execute(['postId' => $postId]);

        return $query->fetchAll();
    }

    // Trouve tout les commentaires non validés

    public function allNotValidated()
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->query("SELECT c.author as commentAuthor,p.title,c.author,c.id,c.content 
                              FROM `comment` AS c 
                              JOIN post as p ON c.postId = p.id 
                              WHERE NOT c.validated 
                              ORDER BY `c`.`id` desc");
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

    // Permet de valider un commentaire

    public function validate(int $id)
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("UPDATE $this->table SET validated = 1 WHERE id = :id");
        $query->execute([
            "id"        => $id,
        ]);
    }
}
