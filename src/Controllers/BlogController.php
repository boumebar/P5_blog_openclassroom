<?php


namespace App\Controllers;

class BlogController extends Controller
{

    public function index()
    {
        $this->rend('home');
    }

    public function showAll()
    {
        $this->rend('home');
    }

    public function show(int $id)
    {

        $this->rend('post', ['id' => $id]);
    }
}
