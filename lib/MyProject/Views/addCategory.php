<div class=" article d-flex flex-column align-items-center">
        <h2 class="h2 mb-5">Ajouter une catégorie</h2>
        <h3 class="h3 mb-5">Trier les categories existantes</h3>
        <div id="simpleList" class="list-group">
        <?php
        foreach($data as $category) {
            echo '<div class="list-group-item"><i class="bi bi-arrows-move"></i>'.$category->getName().'</div>';
        }
        ?>
        <button type="butto," class="btn btn-primary" id="validate-category-sort">Valider</button>

        </div>
        <form method="POST" action="/ajouter-categorie">
        <div class="mb-3">
            <label for="surname" class="form-label required">Nom</label>
            <input required type="text" class="form-control" id="surname" name="category">
        </div>
            <input type="text" id="url" name="url" value="/ajouter-categorie">
            <button type="submit" class="btn btn-secondary">Créer</button>
        </form>
        <div id="empty" class="hidden"></div>
    </div>
    ';