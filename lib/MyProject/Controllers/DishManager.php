<?php

namespace MyProject\Controller;

class DishManager {
    public function index()
    {
        echo 'liste des plats';
    }

    public function show(int $id)
    {
        echo 'je suis le plat '.$id;
    }
}