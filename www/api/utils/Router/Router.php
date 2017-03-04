<?php

namespace Utils\Router;

class Router {

    private $url;
    private $routes = [];
    private $namedRoutes = [];

    public function __construct($url) {
        $this->url = $url;
    }

    public function get($path, $callable, $name = null) {
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null) {
        return $this->add($path, $callable, $name, 'POST');
    }

    private function add($path, $callable, $name, $method) {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if(is_string($callable) && $name === null) {
            $name = $callable;
        }
        if($name) {
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    public function run(){
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']]) && !file_get_contents("php://input")) {
            throw new \Utils\RequestException('bad method', 405);
        }
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if($route->match($this->url)) {
                return $route->call();
            }
        }
        throw new \Utils\RequestException('not found', 404);
    }

    public function url($name, $params = []) {
        if(!isset($this->namedRoutes[$name])) {
            throw new \Utils\RequestException('not found', 404);
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }

}

?>
