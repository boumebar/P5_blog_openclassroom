<?php


namespace App\Router;

class Router
{

    private $url;
    private $routes = [];

    public function __construct(string $url)
    {
        $this->url = trim($url, '/');
    }


    // Enregistre l'url dans le tableur d'url en Get

    public function get(string $path, string $controller)
    {
        $this->routes['GET'][] = new Route($path, $controller);
    }

    // Enregistre l'url dans le tableur d'url en Get

    public function post(string $path, string $controller)
    {
        $this->routes['POST'][] = new Route($path, $controller);
    }

    // Enregistre l'url dans le tableur d'url en Get et en Post

    public function match(string $path, string $controller)
    {
        $this->routes['POST'][] = new Route($path, $controller);
        $this->routes['GET'][] = new Route($path, $controller);
    }

    // lance l'application 

    public function run()
    {
        if (!isset($_SERVER['REQUEST_METHOD'])) {
            throw new RouterException('NO REQUEST METHOD');
        }

        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) {
                return $route->execute();
            }
        }

        throw new RouterException('No routes matches');
    }
}
