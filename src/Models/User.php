<?php


namespace App\Models;


class User extends Model
{

    private $id;
    private $username;
    private $email;
    private $password;
    private $isAdmin;


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername(string $username): self
    {
        $this->username = htmlspecialchars($username);

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password): self
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }

    /**
     * Get the value of isAdmin
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set the value of isAdmin
     *
     * @return  self
     */
    public function setIsAdmin($isAdmin): self
    {
        $this->isAdmin = htmlspecialchars($isAdmin);

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail(string $email): self
    {
        $this->email = htmlspecialchars($email);

        return $this;
    }
}
