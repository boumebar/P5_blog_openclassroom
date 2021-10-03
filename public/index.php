<?php

require_once '../vendor/autoload.php';


use App\Router\Router;

define('SCRIPT', dirname($_SERVER['SCRIPT_NAME']));

define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new Router($_GET['url']);


$router->get('/index', 'App\Controllers\BlogController@index');
$router->get('/posts', 'App\Controllers\BlogController@showAll');
$router->get('/post/:id', 'App\Controllers\BlogController@show');
$router->get('/contact', 'App\Controllers\ContactController@show');
$router->get('/essai', 'App\Controllers\BlogController@essai');


$router->run();
