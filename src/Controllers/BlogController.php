<?php


namespace App\Controllers;

use App\Models\Post;

class BlogController extends Controller
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

        $this->render('blog/show', ['post' => $post]);
    }

    public function essai()
    {
        $this->render('essai');
    }
}
