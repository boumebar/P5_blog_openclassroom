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

    public function all(): array
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->query("SELECT * FROM $this->table ORDER BY createdAt DESC");
        $query->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $query->fetchAll();
    }

    public function findById(int $id): ?Model
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("SELECT * FROM $this->table WHERE id = :id ");
        $query->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        $query->execute(['id' => $id]);
        $model = $query->fetch();

        if ($model === false)
            return null;
        else
            return $model;
    }

    public function create($model)
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("INSERT INTO $this->table VALUES (NULL,:title,:chapo,:author,:content,NOW())");
        $query->execute([
            "title"   =>  $model->getTitle(),
            "chapo"   =>  $model->getChapo(),
            "author"  =>  $model->getAuthor(),
            "content" =>  $model->getContent(),
        ]);
    }

    public function delete(int $id): void
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("DELETE FROM $this->table WHERE id = :id");
        $query->execute(['id' => $id]);
    }

    public function update($data)
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("UPDATE $this->table SET title = :title WHERE id = :id");
        $query->execute([
            'title'  => $data->getTitle(),
            'id'     => $data->getId()

        ]);
    }
}
