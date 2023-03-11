<div class="article d-flex flex-column align-items-center">
        <h2 class="h2 mb-5">Ajouter une catégorie</h2>
        <h3 class="h3 mb-5">Liste des categories existantes</h3>
        <ul>
        <?php
        foreach($data as $category) {
            echo '<ul>'.$category->getName().'</ul>';
        }
        ?>
        </ul>
        <form method="POST" action="/ajouter-categorie">
        <div class="mb-3">
            <label for="surname" class="form-label required">Nom</label>
            <input required type="text" class="form-control" id="surname" name="category">
        </div>
            <input type="text" id="url" name="url" value="/ajouter-categorie">
            <button type="submit" class="btn btn-secondary">Créer</button>
        </form>
    </div>
    ';