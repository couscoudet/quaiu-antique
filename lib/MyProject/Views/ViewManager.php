<?php

namespace MyProject\View;

Class ViewManager {
    private string $path;
    private array $data;

    public function render($path, $data = [])
    {
        $this->setPath($path);
        $this->setData($data);

        ob_start();
        require_once($this->path);
        $content = ob_get_clean();
        require_once('layout.php');
    }

    public function renderAdmin($path, $data = [])
    {
        session_start();
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $this->setPath($path);
            $this->setData($data);

            ob_start();
            require_once($this->path);
            $content = ob_get_clean();
            require_once('layout.php');
        }
        else {
            exit('Vous n\'êtes pas autorisé à consulter cette page<br>
                <a href="/">Retourner à l\'accueil</a>');
        }
    }


    /**
     * Get the value of path
     */ 
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set the value of path
     *
     * @return  self
     */ 
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }


    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}