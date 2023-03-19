<div class="article">
    <h2 class="h2 mb-5">Nos Menus</h2>
    <div class="d-flex flex-column align-items-center">
    
        <?php
        $categories=[];
        foreach( $data['meals'] as $meal) :
        ?>
        <div class="card m-3" style="width:380px;">
            <div class="card-title">
                <h4 class="h3 m-2 text-secondary"><?=$meal->getTitle()?><h4>
            </div>
            <?php 
            foreach($data['arrangements'] as $arrangement):
                if($arrangement->getMeal() == $meal):
            ?>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center" style="width:350px;">
                        <p class="mb-1"><?= $arrangement->getTitle() ?></p>
                        <p class="mb-1"><?= $arrangement->getPrice() ?> €</p>
                </div>
                <p class="description mb-3"><em class="small"> <?= $arrangement->getDescription() ?></em></p>
            </div>
            <div class="card-footer">
            <?php
                    foreach( $meal->getDishes() as $dish) {
                        if($dish->getCategory()) {
                            if (!in_array($dish->getCategory()->getName(),$categories)){
                            $categories[$dish->getCategory()->getCatOrder()] = $dish->getCategory()->getName();
                            }
                        }
            } 
            ksort($categories);
                            foreach($categories as $category) :
            ?>
            <div class="meal-category mb-2">
                <p class=" mb-1"> <strong><?=$category?></strong></p>
                <div class="d-flex flex-wrap">
                <?php               foreach($meal->getDishes() as $dish):
                                        if ($dish->getCategory()) :
                                            if($dish->getCategory()->getName() === $category) :
                ?>
                <span class="badge badge-bg text-primary m-1"><?= $dish->getTitle() ?></span>
            <?php
                                            endif;
                                        endif;
                                    endforeach;
                                ?>
                </div>
            </div>
                                <?php
                            endforeach;
                            ?>
            </div>
            <?php
                endif;
            endforeach; 
            ?>
        </div>         
        <?php endforeach; ?>
</div>
</div>