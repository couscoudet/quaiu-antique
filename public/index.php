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
$router->get('/', 'MyProject\Controller\Dishmanager@index');
$router->get('/plat/:id', 'MyProject\Controller\Dishmanager@show');
$router->get('/créer-plat', 'MyProject\Controller\Dishmanager@create');

$router->run();


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
