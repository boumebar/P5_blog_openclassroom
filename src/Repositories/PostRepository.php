<?php


namespace App\Repositories;

use App\Models\Post;

class PostRepository extends BaseRepository
{

    protected $table = "post";
    protected $class = Post::class;

    public function update(Post $post): void
    {

        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("UPDATE $this->table SET title = :title, author = :author, chapo = :chapo, content = :content WHERE id = :id");
        $query->execute([
            "id"        => $post->getId(),
            "title"     => $post->getTitle(),
            "author"    => $post->getAuthor(),
            "chapo"     => $post->getChapo(),
            "content"   => $post->getContent(),
        ]);
    }

    public function create(Post $post): void
    {

        $pdo = $this->db->getPDO();
        $query = $pdo->prepare("INSERT INTO $this->table (title,author,chapo,content) VALUES (:title, :author, :chapo, :content)");
        $query->execute([
            "title"     => $post->getTitle(),
            "author"    => $post->getAuthor(),
            "chapo"     => $post->getChapo(),
            "content"   => $post->getContent(),
        ]);
    }
}
