<?php

namespace App\Models;

use DateTime;

class Post extends Model
{


    private $id;
    private $title;
    private $author;
    private $chapo;
    private $content;
    private $createdAt;


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = htmlspecialchars($title);

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
        $this->content = htmlspecialchars($content);

        return $this;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt()
    {
        return (new DateTime($this->createdAt))->format('d F Y');
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = htmlspecialchars($createdAt);

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
        $this->author = htmlspecialchars($author);

        return $this;
    }

    /**
     * Get the value of chapo
     */
    public function getChapo()
    {
        return $this->chapo;
    }

    /**
     * Set the value of chapo
     *
     * @return  self
     */
    public function setChapo($chapo)
    {
        $this->chapo = htmlspecialchars($chapo);

        return $this;
    }
}
