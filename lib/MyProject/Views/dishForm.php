

    <div class="article d-flex flex-column align-items-center">
        <h2 class="h2 mb-5">Modifier un plat</h2>
        <form method="POST" action="/modifier-plat" enctype="multipart/form-data">
        <div class="mb-3 hidden">
            <label for="dishId" class="form-label required">Id plat</label>
            <input required type="text" class="form-control" id="dishId" name="dishId" value="<?= $data[0]->getId() ?>">
        </div>
        <div class="mb-3">
            <label for="dishTitle" class="form-label required">Nom du plat</label>
            <input required type="text" class="form-control" id="dishTitle" name="dishTitle" value="<?= $data[0]->getTitle() ?>">
        </div>
        <div class="mb-3">
            <label for="dishPrice" class="form-label required">Prix TTC</label>
            <input required type="number" step="0.01" class="form-control" id="dishPrice" name="dishPrice" value="<?= $data[0]->getPrice()?>">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="activeDish" name="activeDish" <?= ($data[0]->getIsActive() ? 'checked' : '') ?>>
            <label class="form-check-label" for="activeDish">Présent sur la carte ?</label>
        </div>
        <!-- <div class="mb-3"> 
            <?= sprintf('<img width="150px" src="%s">', $data[0]->getGalleryImage() ? '../'.$data[0]->getGalleryImage()->getImageURL() : ''); ?>
            <label for="formFile" class="form-label">Ajouter une image (<5Mo)</label>
            <input class="form-control text-primary" type="file" id="dishImage" name="dishImage">
        </div> -->
            <input type="text" id="url" name="url" value="/modifier-plat">
            <button type="submit" class="btn btn-secondary">Modifier</button>
        </form>
    </div>
