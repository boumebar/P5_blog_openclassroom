<?php


namespace App\Controllers;

use App\Repositories\CommentRepository;
use App\Models\Comment;

class CommentController extends Controller
{


    // Affiche la liste des commentaires pas validés

    public function index()
    {
        $this->isAdmin();
        $comments = (new CommentRepository($this->db))->allNotValidated();
        $this->render('admin/comments/index', ['comments' => $comments]);
    }

    public function create()
    {
        $_SESSION['message'] = [];
        $this->isLogged();
        if (!empty($_POST)) {
            if (!isset($_POST['author']) || empty($_POST['author'])) {
                $_SESSION['message']['erreur'][] = "Le nom est obligatoire";
            };
            if (!isset($_POST['content']) || empty($_POST['content'])) {
                $_SESSION['message']['erreur'][] = "Le commentaire est obligatoire";
            };
            if (!isset($_POST['token']) || empty($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            }

            if (isset($_SESSION['message']['erreur']) && !empty($_SESSION['message']['erreur'])) {
                $this->redirect("post/{$_POST['postId']}");
                exit();
            }
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

    public function delete(int $id)
    {
        $this->isAdmin();
        if (!isset($_POST['token']) || empty($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        }
        $comment = new CommentRepository($this->db);
        $comment->delete($id);
        $this->redirect('comments?delete=1');
    }

    // valider un commentaire 

    public function validate(int $id)
    {
        $this->isAdmin();
        if (!isset($_POST['token']) || empty($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        }
        $comment = new CommentRepository($this->db);
        $comment->validate($id);
        $this->redirect('comments?validate=1');
    }
}
