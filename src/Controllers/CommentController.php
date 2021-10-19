<?php


namespace App\Controllers;

use App\Repositories\CommentRepository;
use App\Models\Comment;

class CommentController extends Controller
{

    public function create()
    {

        if (!empty($_POST)) {
            $commentRepo = new CommentRepository($this->db);
            $comment = (new Comment($this->db));
            $comment
                ->setAuthor($_POST['author'])
                ->setContent($_POST['content'])
            dd($comment);
            $commentRepo->create($comment);
            return header('Location: ' . BASE . "/post/{$_POST['postId']}" . "?add=1");
        } else {
            return header('Location: ' . BASE . "/posts");
        }
    }
}
