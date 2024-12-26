<?php
declare(strict_types= 1);
/**
 * @var Core\Router
 * 
 */

$router->add('GET', '/', 'HomeController@index');
$router->add('GET', '/posts', 'PostController@index');
$router->add('GET', '/posts/{id}', 'PostController@show');

?>