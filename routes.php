<?php
declare(strict_types= 1);
/**
 * @var Core\Router $router;
 */
// 

// TODO:BUG FIX, Project not served on the routes specified
/* require_once __DIR__ . '/core/Router.php';

use Core\Router;

if(!isset($router)){
    $router = new Router();
} */

$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/posts', 'PostController@index');
$router->add('GET', '/posts/{id}', 'PostController@show');

// var_dump($router);
