<?php

require_once '../vendor/autoload.php';


use App\Router\Router;
use App\Router\RouterException;

define('SCRIPT', dirname($_SERVER['SCRIPT_NAME']));
define('BASE', (dirname(dirname($_SERVER['SCRIPT_NAME']))));

define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new Router($_GET['url']);


$router->get('/index', 'App\Controllers\PostController@index');
$router->get('/posts', 'App\Controllers\PostController@showAll');
$router->get('/post/:id', 'App\Controllers\PostController@show');
$router->get('/contact', 'App\Controllers\ContactController@show');
$router->get('/admin', 'App\Controllers\AdminController@index');

//update post
$router->get('/admin/update/:id', 'App\Controllers\AdminController@update');
$router->post('/admin/update/:id', 'App\Controllers\AdminController@update');

//delete post
$router->post('/admin/delete/:id', 'App\Controllers\AdminController@delete');

// add post
$router->get('admin/add', 'App\Controllers\Admincontroller@add');
$router->post('admin/add', 'App\Controllers\Admincontroller@add');


try {
    $router->run();
} catch (RouterException $e) {
    echo $e->getMessage();
}
