<?php


namespace App\Controllers;

use App\Models\Post;
use App\Repositories\PostRepository;

class AdminController extends Controller
{


    public function index()
    {
        $this->isAdmin();
        $posts = (new PostRepository($this->db))->all();

        $this->render('admin/blog/index', ['posts' => $posts]);
    }

    public function delete(int $id)
    {
        $this->isAdmin();
        if (!isset($_POST['token']) || empty($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        }
        $post = new PostRepository($this->db);
        $post->delete($id);
        $this->redirect('admin?delete=1');
    }


    public function update(int $id)
    {
        $_SESSION['message'] = [];
        $this->isAdmin();
        $post = (new PostRepository($this->db))->findById($id);
        if (!empty($_POST)) {
            if (!isset($_POST['title']) || empty($_POST['title'])) {
                $_SESSION['message']['erreur'][] = "Le titre est obligatoire";
            };
            if (!isset($_POST['author']) || empty($_POST['author'])) {
                $_SESSION['message']['erreur'][] = "Le nom de l'auteur est obligatoire";
            };
            if (!isset($_POST['chapo']) || empty($_POST['chapo'])) {
                $_SESSION['message']['erreur'][] = "Le chapô est obligatoire";
            };
            if (!isset($_POST['content']) || empty($_POST['content'])) {
                $_SESSION['message']['erreur'][] = "L'article est obligatoire";
            };
            if (!isset($_POST['token']) || empty($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            }
            if (isset($_SESSION['message']['erreur']) && !empty($_SESSION['message']['erreur'])) {
                $this->render("admin/blog/update", ['post' => $post]);
                exit();
            }
            $postRepo = (new PostRepository($this->db));
            $post
                ->setTitle($_POST['title'])
                ->setChapo($_POST['chapo'])
                ->setAuthor($_POST['author'])
                ->setContent($_POST['content']);
            $postRepo->update($post);
            $this->redirect('admin?update=1');
        } else {
            $this->render('admin/blog/update', ['post' => $post]);
        }
    }

    public function create()
    {
        $_SESSION['message'] = [];
        $this->isAdmin();
        if (!empty($_POST)) {
            if (!isset($_POST['title']) || empty($_POST['title'])) {
                $_SESSION['message']['erreur'][] = "Le titre est obligatoire";
            };
            if (!isset($_POST['author']) || empty($_POST['author'])) {
                $_SESSION['message']['erreur'][] = "Le nom de l'auteur est obligatoire";
            };
            if (!isset($_POST['chapo']) || empty($_POST['chapo'])) {
                $_SESSION['message']['erreur'][] = "Le chapô est obligatoire";
            };
            if (!isset($_POST['content']) || empty($_POST['content'])) {
                $_SESSION['message']['erreur'][] = "L'article est obligatoire";
            };
            if (!isset($_POST['token']) || empty($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            }
            if (isset($_SESSION['message']['erreur']) && !empty($_SESSION['message']['erreur'])) {
                $this->render("admin/blog/create", ['post' => $_POST]);
                exit();
            }

            $post = new Post($this->db);
            $postRepo = (new PostRepository($this->db));
            $post
                ->setTitle($_POST['title'])
                ->setAuthor($_POST['author'])
                ->setChapo($_POST['chapo'])
                ->setContent($_POST['content']);
            $postRepo->create($post);
            $this->redirect('admin?add=1');
        } else {
            $this->render('admin/blog/create');
        }
    }
}
