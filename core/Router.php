<?php
declare(strict_types=1);

namespace Core;

class Router
{
    private array $routes = [];

    public function add(string $method, string $path, array $action): void
    {
        $this->routes[] = ['method' => $method, 'path' => $path, 'action' => $action];
    }

    public function dispatch(string $method, string $path, Container $container): void
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                [$class, $action] = $route['action'];
                $controller = $container->make($class);
                echo $controller->{$action}();
                return;
            }
        }

        http_response_code(404);
        echo '404 - Page introuvable';
    }
}
