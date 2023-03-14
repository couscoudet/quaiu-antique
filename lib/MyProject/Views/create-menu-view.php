<div class="article d-flex flex-column align-items-center">
        <h2 class="h2 mb-5">Ajouter un menu</h2>
        <form method="POST" action="/ajouter-menu">
        <div class="mb-3">
            <label for="title" class="form-label required">Nom</label>
            <input required type="text" class="form-control" id="title" name=data[title]>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Commentaires</label>
            <textarea type="text" class="form-control" id="surname" name=data[comments] rows="3"></textarea>
        </div>
        <h4 class="h4"> Liste des mets associés au menus</h4>
        <div class="dish-check">

        <?php foreach($data as $dish) : ?>
                
            <div class="form-check">
            <input class="form-check-input" type="checkbox" value=<?= $dish->getId(); ?> id="flexCheckDefault" name=data[dishes][]>
            <label class="form-check-label" for="flexCheckDefault">
                <?= $dish->getTitle(); ?>
            </label>
            </div>

        <?php endforeach; ?>
        </div>
            <input type="text" id="url" name="url" value="/ajouter-menu">
            <button type="submit" class="btn btn-secondary">Créer</button>
        </form>
    </div>
    ';