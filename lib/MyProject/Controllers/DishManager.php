<?php

namespace MyProject\Controller;

class DishManager {
    public function index()
    {
        echo 'liste des plats 2023';
    }

    public function show(int $id)
    {
        echo 'je suis le plat '.$id;
    }

    public function create()
    {
        require_once(MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'addDish.php');
    }

    public function confirm()
    {
        require_once(MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'addDishConfirmation.php');
    }

}