<?php


namespace App\Router;

use App\database\DBConnection;
use Exception;

class Route
{


    private $path;
    private $controller;
    private $matches = [];


    public function __construct(string $path, string $controller)
    {
        $this->path = trim($path, "/");
        $this->controller = $controller;
    }

    public function match(string $url)
    {
        // remplace le parametre par une expression régulière (tout sauf / répéter plusieurs fois)
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $pathToMatch = "#^$path$#";
        if (preg_match($pathToMatch, $url, $matches)) {
            $this->matches = $matches;
            return true;
        } else {
            return false;
        }
    }

    public function execute()
    {
        // sépare controller de la methode 
        $params = explode('@', $this->controller);
        $controller = new $params[0](new DBConnection("blog_openclassroom", "127.0.0.1", "root", ""));
        $method = $params[1];

        if (isset($this->matches[1])) {
            $id = (int)$this->matches[1];


            if ($id > 0) {
                return $controller->$method($this->matches[1]);
            } else {
                throw new Exception('Cet id de post n\'existe pas ');
            }
        }

        return $controller->$method();
    }
}
