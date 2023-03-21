<div class="article d-flex flex-column align-items-center">
        <h2 class="h2 mb-5">Ajouter un menu</h2>
        <form style="width:100%;" method="POST" action="/ajouter-menu">
        <div class="mb-3">
            <label for="title" class="form-label required h5">Nom</label>
            <input required type="text" class="form-control" id="title" name=data[title]>
        </div>
        <div class="mb-3">
            <label for="comments" class="form-label h5">Commentaires</label>
            <textarea type="text" class="form-control" id="comments" name=data[comments] rows="3"></textarea>
        </div>
        <h4 class="h4"> Liste des mets associés au menus</h4>
        <div class="dish-check d-flex flex-wrap mb-3">

        <?php foreach($data as $dish) : ?>
                
            <div class="form-check m-1">
            <input class="form-check-input" type="checkbox" value=<?= $dish->getId(); ?> id="flexCheckDefault" name=data[dishes][]>
            <label class="form-check-label" for="flexCheckDefault">
                <?= $dish->getTitle(); ?>
            </label>
            </div>

        <?php endforeach; ?>
        </div>
        <div id="arrangements" class="d-flex flex-column m-4">
            <h4 class="h4"> Formules</h4>
            <div class="arrangement card p-5 m-1 mb-2">
                <div class="mb-3">
                    <label for="arrangementTitle-0" class="form-label required">Titre</label>
                    <input required type="text" class="form-control" id="ArrangementTitle-0" name=data[arrangement][0][title]>
                </div>
                <div class="mb-3">
                    <label for="description-0" class="form-label">Description</label>
                    <textarea type="text" class="form-control" id="description-0" name=data[arrangement][0][description] rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="price-0" class="form-label required">Prix TTC</label>
                    <input required type="number" step="0.01" class="form-control" id="price-0" name=data[arrangement][0][price]>
                </div>
            </div>
            <button type="button" id="add-arrangement" class="btn btn-primary">Ajouter une formule</button>
        </div>
            <input type="text" id="url" name="url" value="/ajouter-menu">
            <button type="submit" class="btn btn-secondary">Créer</button>
        </form>
    </div>