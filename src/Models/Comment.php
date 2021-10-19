<?php


namespace App\Models;

use PDO;


class Comment extends Model
{

    protected $table = "comment";

    private $id;
    private $author;
    private $content;
    private $createdAt;


    // public function findByPostID($postId): array
    // {

    //     $pdo = $this->db->getPDO();

    //     $query = $pdo->prepare('SELECT * FROM comment WHERE postId=:postId ORDER BY createdAt DESC');

    //     $query->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

    //     $query->execute(['postId' => $postId]);

    //     return $query->fetchAll();
    // }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */
    public function setAuthor($author)
    {
        $this->author = htmlentities($author);

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent($content)
    {
        $this->content = nl2br(htmlentities($content));

        return $this;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
