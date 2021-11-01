<?php


namespace App\Repositories;

use App\database\DBConnection;
use PDO;

abstract class BaseRepository
{

    protected $db;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    // affiche tout les elements d'une table 

    public function all(): array
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->query("SELECT * FROM $this->table ORDER BY createdAt DESC");
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class, [$this->db]);
        return $query->fetchAll();
    }

    // Affiche un element d'une table en fonction de son id

    public function findById(int $id): object
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("SELECT * FROM $this->table WHERE id = :id ");
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class, [$this->db]);
        $query->execute(['id' => $id]);
        if ($query->rowCount() === 0) {
            header("Location: " . ROOT . "/404", 404);
            exit();
        } else
            return $query->fetch();
    }

    // Efface un element d'une table en fonction de son id

    public function delete(int $id): void
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("DELETE FROM $this->table WHERE id = :id");
        $query->execute(['id' => $id]);
        if ($query->rowCount() === 0) {
            header("Location: " . ROOT . "/404", 404);
            exit();
        }
    }
}
