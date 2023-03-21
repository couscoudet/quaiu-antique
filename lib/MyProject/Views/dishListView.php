<a type="button" class="btn btn-primary mx-2 my-5" href="/creer-plat">Ajouter un plat</a>
<a type="button" class="btn btn-primary mx-2 my-5" href="/gerer-categories">Gérer Catégories</a>

<table class="table">
            <thead class="thead-light">
                <tr>
                    <th class="text-secondary" scope="col">Nom du plat</th>
                    <th class="text-secondary" scope="col">(€)</th>
                    <th class="text-secondary" scope="col">Image</th>
                    <th class="text-secondary" scope="col">Actif</th>
                    <th class="text-secondary" scope="col"></th>
                </tr>
            </thead>
            <tbody>
        <?php
        $greenIcon = '<i style="color: #16BAC5;" class="bi bi-bookmark-check"></i>';
        $redIcon = '<i style="opacity: 0.35;" class="bi bi-bookmark-x""></i>';
        $linkIcon = '<i class="bi bi-pencil-square mx-1"></i>';
        foreach ($data as $dish) {
        $binIcon = '<i id="'.$dish->getId().'" type="button" class="bi bi-trash3 mx-1 dish-bin" data-bs-toggle="modal" data-bs-target="#deleteModal"></i>';
        echo '<tr>';
        echo sprintf('<th scope="row">%s</th>', $dish->getTitle());
        echo sprintf('<td>%s</td>', number_format($dish->getPrice(),2));
        echo sprintf('<td><img class="table-image" src="%s"></td>', $dish->getGalleryImage() ? $dish->getGalleryImage()->getImageURL() : ASSETS.DIRECTORY_SEPARATOR.'no-image.png');
        echo sprintf('<td>%s</td>', ($dish->getIsActive() ? $greenIcon : $redIcon));
        echo sprintf('<td><a href="/modifier-plat/%s">%s</a>%s</td>', $dish->getId(), $linkIcon,$binIcon);
        echo '</tr>';
        }?>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Etes vous certain de vouloir supprimer ?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="cancel-dish" data-bs-dismiss="modal">Annuler</button>
        <a href="" type="button" class="btn btn-primary" id="delete-dish">Supprimer</a>
      </div>
    </div>
  </div>
</div>
