<?php
namespace App\Core;

class Router {
    private static $routes = [];

    public static function get($uri, $controllerAction) {
        self::$routes["GET"][$uri] = $controllerAction;
    }

    public static function post($uri, $controllerAction) {
        self::$routes["POST"][$uri] = $controllerAction;
    }

    public static function dispatch() {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $method = $_SERVER["REQUEST_METHOD"];
        if (isset(self::$routes[$method][$uri])) {
            [$controller, $action] = explode("@", self::$routes[$method][$uri]);
            $controller = "App\\Controllers\\{$controller}";
            if (class_exists($controller)) {
                $controller = new $controller;
                if (method_exists($controller, $action)) {
                    return $controller->$action();
                } else {
                    http_response_code(404);
                }
            } else {
                http_response_code(404);
            }
        } else {
            http_response_code(404);
        }
    }
    
}
