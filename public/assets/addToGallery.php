<?php

use MyProject\Controller\DishManager;

$id = $_POST['id'];
$dishmanager = new DishManager;
$dishManager->addImageToGallery($id)

?>