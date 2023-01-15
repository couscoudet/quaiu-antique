<?php
require_once 'header.php';
?>
<div class="article d-flex flex-column align-items-center">
    <h2 class="h2 mb-5">Ajouter un plat</h2>
    <form>
    <div class="mb-3">
        <label for="titleInput" class="form-label">Titre</label>
        <input type="text" class="form-control" id="titleInput">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>