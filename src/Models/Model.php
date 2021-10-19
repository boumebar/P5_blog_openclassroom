<?php


namespace App\Models;

use PDO;
use App\database\DBConnection;
use Exception;

abstract class Model
{
    protected $db;
    protected $table;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    // public function all(): array
    // {
    //     $pdo = $this->db->getPDO();
    //     $query = $pdo->query("SELECT * FROM $this->table ORDER BY createdAt DESC");
    //     $query->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
    //     return $query->fetchAll();
    // }

    // public function findById(int $id): ?Model
    // {
    //     $pdo = $this->db->getPDO();
    //     $query = $pdo->prepare("SELECT * FROM $this->table WHERE id = :id ");
    //     $query->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
    //     $query->execute(['id' => $id]);
    //     $model = $query->fetch();

    //     if ($model === false)
    //         return null;
    //     else
    //         return $model;
    // }

    // public function create($data)
    // {

    //     $sqlKeys = "";
    //     $sqlValues = "";
    //     $i = 1;

    //     foreach ($data as $key => $value) {
    //         $virgule = $i == count($data) ? "" : ",";
    //         $sqlKeys .= "{$key}{$virgule}";
    //         $sqlValues .= ":{$key}{$virgule}";
    //         $i++;
    //     }

    //     $pdo = $this->db->getPDO();
    //     $query = $pdo->prepare("INSERT INTO {$this->table} ({$sqlKeys}) VALUES ({$sqlValues})");
    //     $query->execute($data);
    // }

    // public function delete(int $id): void
    // {
    //     $pdo = $this->db->getPDO();
    //     $query = $pdo->prepare("DELETE FROM $this->table WHERE id = :id");
    //     $query->execute(['id' => $id]);
    // }

    // public function update(int $id, array $data)
    // {

    //     $sqlSET = "";
    //     $i = 1;

    //     foreach ($data as $key => $value) {
    //         $virgule = $i == count($data) ? "" : ",";
    //         $sqlSET .= "{$key} = :{$key}{$virgule}";
    //         $i++;
    //     }

    //     $data['id'] = $id;

    //     $pdo = $this->db->getPDO();
    //     $query = $pdo->prepare("UPDATE $this->table SET  {$sqlSET} WHERE id = :id");
    //     $query->execute($data);
    // }
}
