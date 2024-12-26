<?php
declare(strict_types= 1);
/**
 * @var Core\Router $router
 */
// 

// TODO:BUG FIX, Project not served on the routes specified
require_once __DIR__ . '/core/Router.php';

use Core\Router;

if(!isset($router)){
    $router = new Router();
}

$router->add(method:'GET', uri: '/', controller: 'HomeController@index');

$router->add(method:'GET',uri: '/posts', controller:'PostController@index');
$router->add(method:'GET', uri:'/posts/{id}', controller:'PostController@show');

