<?php


namespace App\Controllers;

class BlogController extends Controller
{

    public function index()
    {
        $this->render('home');
    }

    public function showAll()
    {
        $pdo = $this->db->getPDO();
        $posts = $pdo->query('SELECT * FROM post ORDER BY created_at DESC LIMIT 12')->fetchAll();

        $this->render('posts', ['posts' => $posts]);
    }

    public function show(int $id)
    {
        $pdo = $this->db->getPDO();
        $query = $pdo->prepare('SELECT * FROM post WHERE id = :id ');
        $query->execute(['id' => $id]);
        $post = $query->fetch();

        $this->render('post', ['post' => $post]);
    }

    public function essai()
    {
        $this->render('essai');
    }
}
