<?php
declare(strict_types=1);

use Core\Router;


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes.php';


$router = new Router();

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

echo $router->dispatch($uri, $method);

?>