<?php

define("MYPROJECT_DIR", dirname(__DIR__).DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'MyProject');
define("ASSETS", DIRECTORY_SEPARATOR.'assets');

require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'bootstrap.php'; 

require_once MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Routes'.DIRECTORY_SEPARATOR.'routeList.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= ASSETS.DIRECTORY_SEPARATOR.'custom.css'?>" rel="stylesheet">
    <title><?php $pageTitle ?></title>
</head>
<body>
<?php
require_once MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'header.php';

use MyProject\Route\Router;

$router = new Router($_GET['url']);
$router->get('/', 'MyProject\Controller\DishManager@index');
$router->get('/plat/:id', 'MyProject\Controller\DishManager@show');
$router->get('/creer-plat', 'MyProject\Controller\DishManager@create');
$router->run();
// $router->run();
// use MyProject\Controller\DishManager;
// use MyProject\Route\Route;
// $route = ['','MyProject\Controller\Dishmanager+index'];
// $params = ['MyProject\Controller\Dishmanager','index'];
// $peanut = new MyProject\Controller\Dishmanager;
// // $method = 'index';
// $peanut->index();
// echo 'liste des plats 2023';

// $dishManager = new \MyProject\Controller\DishManager;

// echo $_GET['url'] === '' ? $dishManager->index() : 'page non trouvée' ;


?>


<!-- <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown button
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
  </ul>
</div> -->
<?php 
// require_once '../lib/MyProject/Views/footer.php'; ?>
<script src="/assets/bootstrap.bundle.min.js"></script>
</body>
</html>
