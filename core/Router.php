<?php

namespace Core;

class Router
{

    protected $routes = [];

    public function add(string $method, string $uri, string $controller): void
    {

    }

    public function dispatch(string $uri, string $method): string
    {

    }

    protected function findRoute(string $uri, string $method): ?array
    {
        foreach ($this-> routes as $route) {
            $params = $this->matchRoute($route['uri'], $uri);
            if ($params !== null && $route['method'] === $method) {
                return [...$route, 'params' => $params];               
            }
        }

        return null;
    }

    protected function matchRoute(string $routeUri, string $requestUri): ?array
    {
        $routeSegments = explode('/', trim($routeUri, '/'));
        $requestSegments = explode('/', trim($requestUri, '/'));

        if (count($routeSegments) !== count($requestSegments)) {
            return null;
        }

        $params = [];

        foreach ($routeSegments as $index => $routeSegment) {
            if (str_starts_with($routePart, '{') && str_ends_with($routePart, '}') {
                $params[trim($routePart, '{}')] = $requestSegments[$index];
            } elseif($routeSegment !== $requestSegments[$index]) {
                return null;
            }
        }

        return $params;
    }

    protected function callAction(string $controller, string $action, array $params): string
    {
        $controllerClass = "App\\Controller\\$controller";
        return (new $controllerClass)->$action(...$params);
    }
}

?>