<?php

namespace Utils\Router;

class Router {

    static private $url;
    static private $routes = [];
    static private $namedRoutes = [];

    static public function init($url) {
        self::$url = $url;
    }

    static public function get($path, $callable, $name = null) {
        return self::add($path, $callable, $name, 'GET');
    }

    static public function post($path, $callable, $name = null) {
        return self::add($path, $callable, $name, 'POST');
    }

    static private function add($path, $callable, $name, $method) {
        $route = new Route($path, $callable);
        self::$routes[$method][] = $route;
        if(is_string($callable) && $name === null) {
            $name = $callable;
        }
        if($name) {
            self::$namedRoutes[$name] = $route;
        }
        return $route;
    }

    static public function run(){
        if(!isset(self::$routes[$_SERVER['REQUEST_METHOD']]) && !file_get_contents("php://input")) {
            throw new \Utils\RequestException('bad method', 405);
        }
        foreach(self::$routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if($route->match(self::$url)) {
                return $route->call();
            }
        }
        throw new \Utils\RequestException('not found', 404);
    }

    static public function url($name, $params = []) {
        if(!isset(self::$namedRoutes[$name])) {
            throw new \Utils\RequestException('not found', 404);
        }
        return self::$namedRoutes[$name]->getUrl($params);
    }

}
