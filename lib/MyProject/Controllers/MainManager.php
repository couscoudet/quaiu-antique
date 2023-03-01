<?php

namespace MyProject\Controller;

use MyProject\View\ViewManager;

class MainManager
{
    public function home()
    {
        $view = new ViewManager();
        $view->render('home.php');
    }
}