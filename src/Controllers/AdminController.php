<?php


namespace App\Controllers;

use App\Models\Post;

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
        $result = $post->delete($id);

        if ($result) {
            return header('Location: ' . BASE . "/admin");
        }
    }


    public function update($id)
    {
        if (!empty($_POST)) {
            dump($_POST);
            echo 'je suis l\'article' . $id;
        } else {

            $post = (new Post($this->db))->findById($id);
            $this->render('admin/blog/update', ['post' => $post]);
        }
    }

    public function add()
    {
        $this->render('admin/blog/create');
    }


    public function create()
    {
        return header('Location: ' . BASE . "/admin");
    }
}
