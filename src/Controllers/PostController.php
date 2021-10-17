<?php


namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        $posts = (new Post($this->db))->all();

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

        $this->render('blog/show', ['post' => $post, 'comments' => $comments]);
    }
}
