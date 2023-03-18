<h2 class="h2 mb-5">Nos Menus</h2>
<div class="d-flex flex-column align-items-center">
    
    <?php
    $categories=[];
    foreach( $data['meals'] as $meal) :
    ?>
    <h4 class="h3 m-3"><?=$meal->getTitle()?><h4>
            <?php foreach($data['arrangements'] as $arrangement):
            if($arrangement->getMeal() == $meal):
            ?>      
            <div class="d-flex justify-content-between" style="width:350px;">
                <div class="m-2">
                    <p><?= $arrangement->getTitle() ?></p>
                </div>
                <div class="m-2">
                    <p><?= $arrangement->getPrice() ?> €</p>
                </div>
            </div>
            <div class="description"> <?= $arrangement->getDescription() ?></div>
                <?php
                endif;
            endforeach; ?>
        
    <?php endforeach; ?>
</div>