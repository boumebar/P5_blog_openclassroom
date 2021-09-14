<?php


namespace App\Controllers;

class BlogController
{

    public function index()
    {
        echo 'je suis la homepage ';
    }

    public function show($id)
    {

        echo ' je suis le post ' . $id;
    }
}
