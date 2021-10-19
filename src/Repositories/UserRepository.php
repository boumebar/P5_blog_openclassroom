<?php


namespace App\Repositories;

use PDO;
use Exception;
use App\Models\User;

class UserRepository extends BaseRepository
{


    public function findByUsername(string $username): Object
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("SELECT * FROM user WHERE username = :username ");
        $query->setFetchMode(PDO::FETCH_CLASS, User::class, [$this->db]);
        $query->execute(['username' => $username]);
        if ($query->rowCount() === 0)
            throw new Exception("Impossible de trouver le nom $username dans la table user");
        else
            return $query->fetch();
    }
}
