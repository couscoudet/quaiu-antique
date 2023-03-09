<div class="article d-flex flex-column align-items-center">
    <h2 class="h2 mb-5">Gestion de la gallerie d'accueil</h2>
    <div id="cards-container" class="d-flex flex-wrap">
        <?php 
        foreach($data as $image)
        { ?>
        <div class="card m-2" style="width: 10rem;">
            <img style="width: 10rem; height: 10rem; object-fit: cover;"src="<?= $image->getImageURL()?>" class="card-img-top" alt="<?= $image->getImageURL()?>">
            <div class="card-body gallery-manager d-flex justify-content-center">
                <?= $image->getIsActive() ? '<i role="button" style="font-size: 2rem;" id="'.$image->getId().'" class="bi bi-dash-square removeFromGallery"></i>' : '<i role="button" style="font-size: 2rem;" id="'.$image->getId().'" class="bi bi-plus-square addToGallery"></i>'; ?>
            </div>
        </div>
        <?php } ?>

    </div>
</div>