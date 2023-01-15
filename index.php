<?php

require_once 'lib/MyProject/Views/header.php';

$prenom = "yannick";

echo('hello ' . $prenom);?>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown button
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
  </ul>
</div>
<?php require_once 'lib/MyProject/Views/footer.php'; ?>