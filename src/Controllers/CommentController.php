<?php


namespace App\Controllers;

use App\Repositories\CommentRepository;
use App\Models\Comment;

class CommentController extends Controller
{


    public function index()
    {
        $this->isAdmin();
        $comments = (new CommentRepository($this->db))->allNotValidated();
        $this->render('admin/comments/index', ['comments' => $comments]);
    }

    public function create()
    {

        $this->isLogged();
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

    public function delete($id)
    {
        $this->isAdmin();
        $comment = new CommentRepository($this->db);
        $comment->delete($id);
        $this->redirect('comments?delete=1');
    }

    public function validate($id)
    {
        $this->isAdmin();
        $comment = new CommentRepository($this->db);
        $comment->validate($id);
        $this->redirect('comments?validate=1');
    }
}
