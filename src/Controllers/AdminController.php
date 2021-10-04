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
}
