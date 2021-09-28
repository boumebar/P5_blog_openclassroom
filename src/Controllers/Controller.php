<?php

namespace App\Controllers;


class Controller
{

    protected $twig;

    public function rend(string $page, ?array $params = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/views');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => false,
            'debug' => true
        ]);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());

        echo $this->twig->render($page . '.twig', $params);
    }
}
