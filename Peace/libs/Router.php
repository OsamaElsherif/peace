<?php
namespace Peace\libs;

use InvalidArgumentException;

class Router
{
    private array $routes = [];
    private array $namedRoutes = [];

    public function get(string $path, callable $handler, ?string $name = null): void {
        $this->addRoute('GET', $path, $handler, $name);
    }

    public function post(string $path, callable $handler, ?string $name = null): void {
        $this->addRoute('POST', $path, $handler, $name);
    }

    public function put(string $path, callable $handler, ?string $name = null): void {
        $this->addRoute('PUT', $path, $handler, $name);
    }

    public function patch(string $path, callable $handler, ?string $name = null): void {
        $this->addRoute('PATCH', $path, $handler, $name);
    }

    public function delete(string $path, callable $handler, ?string $name = null): void {
        $this->addRoute('DELETE', $path, $handler, $name);
    }

    private function addRoute(string $method, string $path, callable $handler, ?string $name): void {
        $this->routes[$method][] = [
            'path' => $path,
            'handler' => $handler,
            'name' => $name,
        ];

        if ($name) {
            $this->namedRoutes[$name] = $path;
        }
    }

    public function dispatch(): void {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (StaticFilesHandler::handle($uri)) {
            return;
        }

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route) {
                $path = $route['path'];
                $handler = $route['handler'];
                // Convert the route into a regex with placeholders.
                $pattern = preg_replace('/\{([^\/]+)\}/', '(?P<$1>[^\/]+)', str_replace('/', '\/', $path));
                if (preg_match("#^$pattern$#", $uri, $matches)) {
                    // Extract route parameters.
                    $params = array_filter($matches, fn($key) => is_string($key), ARRAY_FILTER_USE_KEY);
                    call_user_func($handler, $params);
                    return;
                }
            }
        }


        // If no route matched, send 404
        http_response_code(404);
        echo '404 Not Found';
    }

    public function route(string $name, array $params = []): string {
        if (!isset($this->namedRoutes[$name])) {
            throw new InvalidArgumentException("No route found with name: $name");
        }

        $path = $this->namedRoutes[$name];

        // Replace parameters in the URL
        foreach ($params as $key => $value) {
            $path = str_replace("{{$key}}", $value, $path);
        }

        // If there are still unmatched parameters, throw an exception.
        if (preg_match('/\{[^\/]+\}/', $path)) {
            throw new InvalidArgumentException("Not all parameters were replaced in the route with name: {$name}");
        }

        return $path;
    }

    public function getCurrentRouteName(): ?string {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route) {
                $path = $route['path'];
                $name = $route['name'];
                // Convert the route into a regex with placeholders.
                $pattern = preg_replace('/\{([^\/]+)\}/', '(?P<$1>[^\/]+)', str_replace('/', '\/', $path));

                if (preg_match("#^$pattern$#", $uri, $matches)) {
                    return $name;
                }
            }
        }
        return null;
    }

}