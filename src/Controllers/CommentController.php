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
                ->setPostId($_POST['postId']);
            $commentRepo->create($comment);
            $this->redirect("post/{$_POST['postId']}?add=1");
        } else {
            $this->redirect("posts");
        }
    }
}
