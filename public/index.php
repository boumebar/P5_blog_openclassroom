<?php


use App\Router\Router;

require '../vendor/autoload.php';



$router = new Router($_GET['url']);

$router->get('/posts', 'BlogController', 'index');
$router->get('/posts/:id', 'BlogController', 'show');
$router->post('/posts/:id', 'BlogController', 'show');

$router->run();
