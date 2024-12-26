<?php
declare(strict_types=1);

use Core\Router;

require_once __DIR__ . '/../bootstrap.php';

var_dump($config);
// Initialize the Router
$router = new Router();

// Include routes (uses the $router instance)
require_once __DIR__ . '/../routes.php';

// Get the current URI and request method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Dispatch the router
echo $router->dispatch($uri, $method);
