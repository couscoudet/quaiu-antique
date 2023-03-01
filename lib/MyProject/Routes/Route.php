<?php

namespace MyProject\Route;

class Route {
    public $path;
    public $controller;
    public $matches;
    private $needEntityManager;

    public function __construct($path, $controller, $needEntityManager=false)
    {
        $this->path = trim($path, '/');
        $this->controller = $controller;
        $this->needEntityManager = $needEntityManager;
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

    public function execute($em=null)
    {
        $params = explode('@',$this->controller);
        $controller = new $params[0]();
        if (isset($em)){
            $controller->setEm($em);
        }
        $method = $params[1];
        $postparam = isset($params[2]) ? $params[2] : null;
        if (isset($this->matches[1])){
           return $controller->$method($this->matches[1]);
        } 
        elseif ($postparam && isset($_POST[$postparam])) {
                return $controller->$method($_POST[$postparam]);
        }
        else {
            $controller->$method();
        }
    }

    /**
     * Get the value of needEntityManager
     */ 
    public function getNeedEntityManager()
    {
        return $this->needEntityManager;
    }

    /**
     * Set the value of needEntityManager
     *
     * @return  self
     */ 
    public function setNeedEntityManager($needEntityManager)
    {
        $this->needEntityManager = $needEntityManager;

        return $this;
    }
}