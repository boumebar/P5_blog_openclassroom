<?php


namespace App\Controllers;

use App\Models\Post;
use App\Repositories\PostRepository;

class AdminController extends Controller
{


    public function index()
    {

        $posts = (new PostRepository($this->db))->all();

        $this->render('admin/blog/index', ['posts' => $posts]);
    }

    public function delete(int $id)
    {
        $post = new PostRepository($this->db);
        $post->delete($id);
        return header('Location: ' . BASE . "/admin" . "?delete=1");
    }


    public function update(int $id)
    {
        $post = (new PostRepository($this->db))->findById($id);
        if (!empty($_POST)) {
            $postRepo = (new PostRepository($this->db));
            $post
                ->setTitle($_POST['title'])
                ->setChapo($_POST['chapo'])
                ->setAuthor($_POST['author'])
                ->setContent($_POST['content']);
            $postRepo->update($post);
            return header('Location: ' . BASE . "/admin" . "?update=1");
        } else {
            $this->render('admin/blog/update', ['post' => $post]);
        }
    }

    public function create()
    {
        if (!empty($_POST)) {
            $post = new Post($this->db);
            $postRepo = (new PostRepository($this->db));
            $post
                ->setTitle($_POST['title'])
                ->setAuthor($_POST['author'])
                ->setChapo($_POST['chapo'])
                ->setContent($_POST['content']);
            $postRepo->create($post);
            return header('Location: ' . BASE . "/admin" . "?add=1");
        } else {
            $this->render('admin/blog/create');
        }
    }
}
