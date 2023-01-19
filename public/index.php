<?php

// require_once '/../lib/MyProject/Views/header.php';

$prenom = isset($_GET['url']) ? ($_GET['url']) : ('pas de parametre url');

echo('hello mon ' . $prenom);

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