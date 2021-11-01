<?php


namespace App\Repositories;

use PDO;
use Exception;
use App\Models\User;

class UserRepository extends BaseRepository
{


    // trouve par nom

    public function findByUsername(string $username): User
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

    // trouve par email
    public function findByEmail(string $email): ?User
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("SELECT * FROM user WHERE email = :email ");
        $query->setFetchMode(PDO::FETCH_CLASS, User::class, [$this->db]);
        $query->execute(['email' => $email]);
        if ($query->rowCount() === 0)
            return null;
        else
            return $query->fetch();
    }


    public function create(User $user): void
    {

        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("INSERT INTO user (username,email,password) VALUES (:username, :email, :password)");
        $query->execute([
            "username"     => $user->getUsername(),
            "email"    => $user->getEmail(),
            "password"     => $user->getPassword(),
        ]);
    }
}
