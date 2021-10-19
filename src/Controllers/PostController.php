<?php


namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use Exception;

class PostController extends Controller
{

    public function index()
    {
        $this->render('home');
    }

    public function showAll()
    {
        $posts = (new PostRepository($this->db))->all();

        $this->render('blog/index', ['posts' => $posts]);
    }

    public function show(int $id)
    {
        $post = (new PostRepository($this->db))->findById($id);
        $comments = (new CommentRepository($this->db))->findValidatedByPostID($id);
        $this->render('blog/show', ['post' => $post, 'comments' => $comments]);
    }
}
