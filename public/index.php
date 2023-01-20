<?php
require_once __DIR__.'/../bootstrap.php'; 
require_once __DIR__.'/../lib/MyProject/Routes/routeList.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/../../../public/assets/custom.css" rel="stylesheet">
    <title><?php $pageTitle ?></title>
</head>
<body>
<?php
require_once __DIR__.'/../lib/MyProject/Views/header.php';

use MyProject\Route\Router;

// $router = new Router($_SERVER['REQUEST_URI']);
// $router->get('/', 'MyProject\Controller\Dishmanager@index');
// $router->get('/plat/:id', 'MyProject\Controller\Dishmanager@show');

// $router->run();

var_dump($_GET);
var_dump($_SERVER);

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
<script src="../../../public/assets/bootstrap.bundle.min.js"></script>
</body>
</html>
