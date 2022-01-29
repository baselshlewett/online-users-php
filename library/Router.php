<?php

namespace Library;

class Router {
    private $_url = null;

    private static $_routes = [];
    
    function __construct() {}

    public function init(): void
    {
        // prepares request url
        $this->_getUrl();
        
        if (empty(self::$_routes[$this->_url])) {
            error(404, "Route not found");
            return;
        }

        if (!$this->_checkMethodAllowed()) {
            error(405, "Method not allowed");
            return;
        }

        //check if controller exists, load it (url)
        $this->_loadController(self::$_routes[$this->_url]);
    }

    public static function get(string $route, string $controller): void
    {
        $controllerFunction = self::checkController($controller);

        if (!$controllerFunction) {
            return;
        }

        self::register($route, $controllerFunction[0], $controllerFunction[1], 'GET');
    }

    public static function post(string $route, string $controller): void
    {
        $controllerFunction = self::checkController($controller);

        if (!$controllerFunction) {
            return;
        }

        self::register($route, $controllerFunction[0], $controllerFunction[1], 'POST');
    }

    public static function delete(string $route, string $controller): void
    {
        $controllerFunction = self::checkController($controller);

        if (!$controllerFunction) {
            return;
        }

        self::register($route, $controllerFunction[0], $controllerFunction[1], 'DELETE');
    }

    public static function put(string $route, string $controller): void
    {
        $controllerFunction = self::checkController($controller);

        if (!$controllerFunction) {
            return;
        }

        self::register($route, $controllerFunction[0], $controllerFunction[1], 'PUT');
    }

    public static function register(string $route, string $controller, string $function, string $method): void
    {
        self::$_routes[$route] = ['controller' => $controller, 'function' =>  $function, 'method' => $method];
    }

    public static function checkController(string $controller): mixed
    {
        $controllerFunction = explode('@', $controller);

        if (empty($controllerFunction[0]) || empty($controllerFunction[1])) {
            return false;
        }

        $controllerName = $controllerFunction[0];
        $functionName = $controllerFunction[1];

        if (!class_exists("\\Controllers\\" . $controllerName)) {
            return false;
        }

        if (!method_exists("\\Controllers\\" . $controllerName, $functionName)) {
            return false;
        }

        return $controllerFunction;
    }

    private function _checkMethodAllowed(): bool 
    {
        return self::$_routes[$this->_url]['method'] === $_SERVER['REQUEST_METHOD'];
    }

    private function _getUrl(): void
    {
        $baseUrl = strtok($_SERVER["REQUEST_URI"], '?');
        $url = rtrim($baseUrl, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = empty($url) ? '/' : $url;
        return;
    }

    private function _loadController(array $controllerArr): void
    {
        $controllerString = "\\Controllers\\" . $controllerArr['controller'];
        $controllerFunction = $controllerArr['function'];
        $controller = new $controllerString();

        $controller->{$controllerFunction}(parse_json_request());

        return;
    }
}
