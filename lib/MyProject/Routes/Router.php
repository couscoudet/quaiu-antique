<?php

namespace MyProject\Route;

class Router {

    public $url;

    public $routes=[];

    private $em;

    public function __construct($url, $entityManager){
        $this->url = trim($url, '/');
        $this->em = $entityManager;
    }

    public function show(){
        echo $this->url;
    }

    public function get($path, $controller, $needEntityManager){
        $this->routes['GET'][] = new Route($path, $controller, $needEntityManager);
    }

    public function post($path, $controller, $needEntityManager){
        $this->routes['POST'][] = new Route($path, $controller, $needEntityManager);
    }

    public function run(){
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
           if ($route->matches($this->url)) {
                $route->getNeedEntityManager() ? $route->execute($this->em) : $route->execute();
           };
        }
        return header('HTTP/1.0 404 NOT FOUND');    
    }
}