<?php


namespace App\Models;

use PDO;
use App\database\DBConnection;

abstract class Model
{
    protected $db;
    protected $table;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    public function all(): array
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->query("SELECT * FROM $this->table ORDER BY createdAt DESC");
        $query->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $query->fetchAll();
    }

    public function findById(int $id): Model
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("SELECT * FROM $this->table WHERE id = :id ");
        $query->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    public function delete(int $id): bool
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("DELETE FROM $this->table WHERE id = :id");
        return $query->execute(['id' => $id]);
    }

    public function update(int $id): bool
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("UPDATE $this->table SET WHERE id = :id");
        return $query->execute([
            'id'  => $id,

        ]);
    }
}
