<?php

require_once '../vendor/autoload.php';


use App\Router\Router;
use App\Router\RouterException;

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
$router->get('/admin', 'App\Controllers\AdminController@index');

//update post
$router->get('/admin/update/:id', 'App\Controllers\AdminController@update');
$router->post('/admin/update_post/:id', 'App\Controllers\AdminController@updatePost');

//delete post
$router->post('/admin/delete/:id', 'App\Controllers\AdminController@delete');


try {
    $router->run();
} catch (RouterException $e) {
    echo $e->getMessage();
}
