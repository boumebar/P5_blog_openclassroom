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

    public function delete()
    {
        echo 'delete';
    }


    public function update()
    {
        $this->render('admin/blog/update');
    }
}
