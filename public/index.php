<?php

define("MYPROJECT_DIR", dirname(__DIR__).DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'MyProject');
define("ASSETS", DIRECTORY_SEPARATOR.'assets');
define("ROOTDIR", dirname(__DIR__));
define("PUBLIC_DIR", __DIR__);
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'bootstrap.php'; 

require_once MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Routes'.DIRECTORY_SEPARATOR.'routeList.php';


use MyProject\Route\Router;

if (isset($_POST['url'])) {
  $router = new Router($_POST['url'], $entityManager);
  $router->post('/confirmer-plat', 'MyProject\Controller\DishManager@confirm', false);
  $router->post('/envoyer-plat', 'MyProject\Controller\DishManager@addDishToDB@data', true);
  $router->post('/creer-utilisateur', 'MyProject\Controller\UserManager@addUser@data', true);
  $router->post('/creer-administrateur', 'MyProject\Controller\UserManager@addAdmin@data', true);
  $router->post('/login', 'MyProject\Controller\UserManager@logUser@data', true);
  $router->post('/modifier-plat', 'MyProject\Controller\DishManager@modify', true);
  // $router->post('/envoyer-utilisateur', 'MyProject\Controller\DishManager@addDishToDB@data', true);
  $router->run();
}
else {
  $router = new Router($_GET['url'], $entityManager);
  $router->get('/', 'MyProject\Controller\MainManager@home', false);
  $router->get('/plats', 'MyProject\Controller\DishManager@index', true);
  $router->get('/plat/:id', 'MyProject\Controller\DishManager@show', false);
  $router->get('/creer-plat', 'MyProject\Controller\DishManager@create', false);
  $router->get('/creer-utilisateur', 'MyProject\Controller\UserManager@addUser', true);
  $router->get('/creer-administrateur', 'MyProject\Controller\UserManager@addAdmin', true);
  $router->get('/modifier-plat/:id', 'MyProject\Controller\DishManager@modify', true);
  $router->get('/delete-dish/:id', 'MyProject\Controller\DishManager@delete', true);
  $router->get('/ajout-visiteur/:email', 'MyProject\Controller\UserManager@addVisitor', true);
  $router->get('/login', 'MyProject\Controller\UserManager@logUser', false);

  $router->run();
}
?>
