<?php


namespace App\Models;



class Comment extends Model
{


    private $id;
    private $author;
    private $content;
    private $createdAt;
    private $postId;
    private $validated;


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
    public function setId(int $id)
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
    public function setAuthor(string $author)
    {
        $this->author = htmlspecialchars($author);

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
    public function setContent(string $content)
    {
        $this->content = htmlspecialchars($content);

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
        $this->createdAt = htmlspecialchars($createdAt);

        return $this;
    }

    /**
     * Get the value of postId
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set the value of postId
     *
     * @return  self
     */
    public function setPostId(int $postId)
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * Get the value of validated
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * Set the value of validated
     *
     * @return  self
     */
    public function setValidated(int $validated)
    {
        $this->validated = htmlspecialchars($validated);

        return $this;
    }
}
