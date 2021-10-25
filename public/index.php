<?php

require_once '../vendor/autoload.php';


use App\Router\Router;
use App\Router\RouterException;

define('SCRIPT', dirname($_SERVER['SCRIPT_NAME']));
define('ROOT', dirname(dirname($_SERVER['SCRIPT_NAME'])));


define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler);
$whoops->register();

// dd($_GET);
$router = new Router($_GET['url']);


$router->get('/index', 'App\Controllers\PostController@index');
$router->get('/posts', 'App\Controllers\PostController@showAll');
$router->get('/post/:id', 'App\Controllers\PostController@show');
$router->get('/contact', 'App\Controllers\ContactController@show');
$router->get('/admin', 'App\Controllers\AdminController@index');

//update post
$router->match('/admin/update/:id', 'App\Controllers\AdminController@update');

//delete post
$router->post('/admin/delete/:id', 'App\Controllers\AdminController@delete');

// add post
$router->match('/admin/add', 'App\Controllers\AdminController@create');

// add Comment
$router->post('/comment/add', 'App\Controllers\CommentController@create');

$router->get('/comments', 'App\Controllers\CommentController@index');

//delete Comment
$router->post('/comment/delete/:id', 'App\Controllers\CommentController@delete');

//validate Comment
$router->post('/comment/validate/:id', 'App\Controllers\CommentController@validate');

// register
$router->match('/register', 'App\Controllers\AuthController@register');

// login
$router->match('/login', 'App\Controllers\AuthController@login');

// logout
$router->get('/logout', 'App\Controllers\AuthController@logout');

try {
    $router->run();
} catch (RouterException $e) {
    echo $e->getMessage();
}
