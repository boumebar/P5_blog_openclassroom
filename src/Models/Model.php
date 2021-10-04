<?php


namespace App\Models;

use PDO;
use App\Models\Post;
use App\database\DBConnection;

abstract class Model
{
    protected $db;
    protected $table;
    protected $class;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    public function all(): array
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->query("SELECT * FROM $this->table ORDER BY created_at DESC");
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class, [$this->db]);
        return $query->fetchAll();
    }

    public function findById($id): array
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("SELECT * FROM $this->table WHERE id = :id ");
        $query->execute(['id' => $id]);
        return $query->fetch();
    }
}
