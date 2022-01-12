<?php
class Router {
    private array $routes;

    // registering a route
    private function register(string $REQ, string $route, callable $function): self {
        $this->routes[$REQ][$route] = $function;

        return $this;
    }
    // get request route  
    public function get(string $route, callable $function): self {
        return $this->register('GET', $route, $function);
    }
    // post request route
    public function post(string $route, callable $function): self {
        return $this->register('POST', $route, $function);
    }
    // resolving the URI for finding the matched route
    public function resolve(string $URI, string $REQ) {
        $route = explode('?', $URI)[0];
        $function = $this->routes[$REQ][$route] ?? null;
        
        if (!$function) {
            die('404');
        }
        
        return call_user_func($function);
    }
}
?>