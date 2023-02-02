<?php

namespace MyProject\Route;

class Router {

    public $url;

    public $routes=[];

    public function __construct($url){
        $this->url = trim($url, '/');
    }

    public function show(){
        echo $this->url;
    }

    public function get($path, $controller){
        $this->routes['GET'][] = new Route($path, $controller);
    }

    public function post($path, $controller){
        $this->routes['POST'][] = new Route($path, $controller);
    }

    public function run(){
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
           if ($route->matches($this->url)) {
                $route->execute();
           };
        }
        return header('HTTP/1.0 404 NOT FOUND');    
    }
}