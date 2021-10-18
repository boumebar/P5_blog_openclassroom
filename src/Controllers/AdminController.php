<?php


namespace App\Controllers;

use App\Models\Post;
use Exception;

class AdminController extends Controller
{


    public function index()
    {

        $posts = (new Post($this->db))->all();

        $this->render('admin/blog/index', ['posts' => $posts]);
    }

    public function delete($id)
    {
        $post = new Post($this->db);
        $post->delete($id);
        return header('Location: ' . BASE . "/admin" . "?delete=1");
    }


    public function update($id)
    {
        if (!empty($_POST)) {
            $post = (new Post($this->db));
            $post->getId($id);
            $post->setTitle($_POST['title']);
            $post->update($post);
        } else {
            $post = (new Post($this->db))->findById($id);
            if ($post == null) {
                throw new Exception("Cet article n'existe pas");
            } else {
                $this->render('admin/blog/update', ['post' => $post]);
            }
        }
    }

    public function add()
    {
        if (!empty($_POST)) {
            $post = (new Post($this->db));
            $post->setTitle($_POST['title']);
            $post->setChapo($_POST['chapo']);
            $post->setAuthor($_POST['author']);
            $post->setContent($_POST['content']);
            $post->create($post);
            return header('Location: ' . BASE . "/admin" . "?add=1");
        } else {
            $this->render('admin/blog/create');
        }
    }
}
