<?php


namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Exception;

class PostController extends Controller
{

    public function index()
    {
        $this->render('home');
    }

    public function showAll()
    {
        $posts = (new Post($this->db))->all();

        $this->render('blog/index', ['posts' => $posts]);
    }

    public function show(int $id)
    {

        $post = (new Post($this->db))->findById($id);
        $comments = (new Comment($this->db))->findByPostID($id);
        if ($post) {
            $this->render('blog/show', ['post' => $post, 'comments' => $comments]);
        } else
            throw new Exception("L'article avec l'id $id n'existe pas ");
    }
}
