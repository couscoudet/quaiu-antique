<h2 class="h2">Liste des menus</h2>
<a type="button" class="btn btn-primary mx-2 my-5" href="/ajouter-menu">Ajouter un menu</a>

<?php foreach($data as $meal) : ?>

<h5 class="h5"><?=$meal->getTitle()?><i id=<?=$meal->getId()?> type="button" class="bi bi-trash3 ms-5 meal-bin" data-bs-toggle="modal" data-bs-target="#deleteModal"></i></h5>

<?php endforeach; ?>


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Etes vous certain de vouloir supprimer ?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="cancel-meal" data-bs-dismiss="modal">Annuler</button>
        <a href="" type="button" class="btn btn-primary" id="delete-meal">Supprimer</a>
      </div>
    </div>
  </div>
</div>
