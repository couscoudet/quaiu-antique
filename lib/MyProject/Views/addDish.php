    <div class="article d-flex flex-column align-items-center">
        <h2 class="h2 mb-5">Ajouter un plat</h2>
        <form method="POST" action="/confirmer-plat" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="dishTitle" class="form-label required">Nom du plat</label>
            <input required type="text" class="form-control" id="dishTitle" name="dishTitle">
        </div>
        <div class="mb-3">
            <label for="dishPrice" class="form-label required">Prix TTC</label>
            <input required type="number" step="0.01" class="form-control" id="dishPrice" name="dishPrice">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="activeDish" name="activeDish">
            <label class="form-check-label" for="activeDish">Présent sur la carte ?</label>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Ajouter une image (<1Mo)</label>
            <input class="form-control text-primary" type="file" id="dishImage" name="dishImage">
        </div>
            <input type="text" id="url" name="url" value="/confirmer-plat">
            <button type="submit" class="btn btn-secondary">Créer</button>
        </form>
    </div>
    ';
