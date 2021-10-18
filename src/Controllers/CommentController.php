<?php


namespace App\Controllers;

use App\Models\Comment;

class CommentController extends Controller
{

    public function add()
    {
        if (!empty($_POST)) {
            $comment = (new Comment($this->db));
            $comment->setAuthor($_POST['author']);
            $comment->setContent($_POST['content']);
            $comment->create($comment);
            return header('Location: ' . BASE . "/admin" . "?add=1");
        } else {
            $this->render('admin/blog/create');
        }
    }
}
