<?php

namespace App\Controllers;

use App\database\DBConnection;
use Twig\Extra\String\StringExtension;

abstract class Controller
{

    protected $twig;
    protected $db;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    public function render(string $page, ?array $params = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/views');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => false,
            'debug' => true
        ]);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        $this->twig->addExtension(new StringExtension());
        $this->twig->addGlobal('_post', $_POST);
        $this->twig->addGlobal('_get', $_GET);


        echo $this->twig->render($page . '.twig', $params);
    }
}
