<?php


namespace App\Models;

use PDO;


class Comment extends Model
{

    public function findByPostID($post_id): array
    {

        $pdo = $this->db->getPDO();

        $query = $pdo->prepare('SELECT * FROM comment WHERE post_id=:post_id ORDER BY created_at DESC');

        $query->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

        $query->execute(['post_id' => $post_id]);

        return $query->fetchAll();
    }
}
