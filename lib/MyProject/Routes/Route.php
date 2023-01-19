<?php

namespace MyProject\Route;

class Route {
    public $path;
    public $controller;
    public $matches;

    public function __construct($path, $controller)
    {
        $this->path = trim($path, '/');
        $this->controller = $controller;
    }

    public function matches($url)
    {
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $pathToMatch = "#^$path$#";

        if (preg_match($pathToMatch, $url, $matches)) {
            $this->matches = $matches;
            return true;
        }
        else {
            return false;
        }
    }

    public function execute()
    {
        $params = explode('@',$this->controller);
        $controller = new $params[0]();
        $method = $params[1];

        return isset($this->matches[1]) ?  $controller->$method($this->matches[1]) : $controller->$method();

    }
}