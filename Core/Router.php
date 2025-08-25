<?php

namespace Core;

use Core\Middleware\Middleware;

class Router
{
    protected array $routes = [];

    public function add_routes($uri, $controller, $method): static
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,
            'params' => null,
        ];

        return $this;
    }

    public function get($uri, $controller): static
    {
        return $this->add_routes($uri, $controller, 'GET');
    }

    public function post($uri, $controller): static
    {
        return $this->add_routes($uri, $controller, 'POST');
    }

    public function delete($uri, $controller): static
    {
        return $this->add_routes($uri, $controller, 'DELETE');
    }

    public function patch($uri, $controller): static
    {
        return $this->add_routes($uri, $controller, 'PATCH');
    }

    public function put($uri, $controller): static
    {
        return $this->add_routes($uri, $controller, 'PUT');
    }

    public function only($key): static
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function params($key): void
    {
        $this->routes[array_key_last($this->routes)]['params'] = $key;
    }

    /**
     * @throws \Exception
     */
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);
                Middleware::handle($route['params']);

                return require base_path("/Http/controllers/" . $route['controller']);
            }
        }

        $this->abort();
    }

    public function previous_url()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    protected function abort($code = 404): void
    {
        http_response_code($code);

        require base_path("Http/views/{$code}.php");

        die();
    }
}
