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


    public function get(string $path, string $controller)
    {
        $this->routes['GET'][] = new Route($path, $controller);
    }

    public function post(string $path, string $controller)
    {
        $this->routes['POST'][] = new Route($path, $controller);
    }

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
