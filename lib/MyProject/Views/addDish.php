<?php
require_once 'header.php';
?>
<div class="article d-flex flex-column align-items-center">
    <h2 class="h2 mb-5">Ajouter un plat</h2>
    <form>
    <div class="mb-3">
        <label for="dishTitle" class="form-label">Nom du plat</label>
        <input type="text" class="form-control" id="dishTitle">
    </div>
    <div class="mb-3">
        <label for="dishPrice" class="form-label">Prix TTC</label>
        <input type="number" step="0.01" class="form-control" id="dishPrice">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="activeDish">
        <label class="form-check-label" for="activeDish">Présent sur la carte ?</label>
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">Ajouter une image</label>
        <input class="form-control text-primary" type="file" id="formFile">
    </div>

    <button type="submit" class="btn btn-secondary">Créer</button>
    </form>
</div>