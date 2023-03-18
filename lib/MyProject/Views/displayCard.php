<h2 class="h2 mb-5">A la Carte</h2>
<div class="d-flex flex-column align-items-center">
    
    <?php
    $categories=[];
    foreach( $data as $dish) {
        if($dish->getCategory()) {
            if (!in_array($dish->getCategory()->getName(),$categories)){
                $categories[$dish->getCategory()->getCatOrder()] = $dish->getCategory()->getName();
            }
            }
    }
    ksort($categories);
    foreach($categories as $category) :
    ?>
    <h4 class="h4 m-3"><?=$category?><h4>
            <?php foreach($data as $dish):
            if ($dish->getCategory()) :
                if($dish->getCategory()->getName() === $category) :
            ?>        
            <div class="d-flex justify-content-between" style="width:350px;">
                <div class="m-2">
                    <p><?= $dish->getTitle() ?></p>
                </div>
                <div class="m-2">
                    <p><?= $dish->getPrice() ?> €</p>
                </div>
            </div>
                <?php endif;
            endif;
            endforeach; ?>
        
    <?php endforeach ?>
</div>