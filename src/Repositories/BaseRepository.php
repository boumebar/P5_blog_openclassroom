<?php


namespace App\Repositories;

use App\database\DBConnection;
use Exception;
use PDO;

abstract class BaseRepository
{

    protected $db;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    public function all(): array
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->query("SELECT * FROM $this->table ORDER BY createdAt DESC");
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class, [$this->db]);
        return $query->fetchAll();
    }

    public function findById(int $id): object
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("SELECT * FROM $this->table WHERE id = :id ");
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class, [$this->db]);
        $query->execute(['id' => $id]);
        if ($query->rowCount() === 0)
            throw new Exception("Impossible de trouver l'element $id dans la table $this->table");
        else
            return $query->fetch();
    }

    public function delete(int $id): void
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("DELETE FROM $this->table WHERE id = :id");
        $query->execute(['id' => $id]);
        if ($query->rowCount() === 0) {
            throw new Exception("Impossible de supprimer l'element $id dans la table $this->table");
        }
    }
}
