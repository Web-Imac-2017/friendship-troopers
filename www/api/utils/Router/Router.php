<?php

namespace Utils\Router;

class Router {

    static private $url;
    static private $routes = [];
    static private $namedRoutes = [];

    static public function init($url) {
        self::$url = $url;
    }

    static public function __callStatic($method, $args) {
        if (!in_array($method, ['get', 'post', 'put', 'delete', 'patch', 'options', 'head'])) {
            throw new \Exception('unknown method');
        }
        $args[2] = $args[2] ?? null;
        $args[3] = strtoupper($method);

        return call_user_func_array([get_called_class(), 'add'], $args);
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
        return '/' . self::$namedRoutes[$name]->getUrl($params);
    }

}
