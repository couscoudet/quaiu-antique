
<table class="table">
            <thead class="thead-light">
                <tr>
                    <th class="text-secondary" scope="col">Nom du plat</th>
                    <th class="text-secondary" scope="col">Prix (€)</th>
                    <th class="text-secondary" scope="col">Image</th>
                    <th class="text-secondary" scope="col">A la carte ?</th>
                </tr>
            </thead>
            <tbody>
        <?php
        $greenIcon = '<i style="color: #16BAC5;" class="bi bi-bookmark-check"></i>';
        $redIcon = '<i style="opacity: 0.35;" class="bi bi-bookmark-x""></i>';
        $linkIcon = '<i class="bi bi-pencil-square m-1"></i>';
        $binIcon = '<i class="bi bi-trash3 m-1"></i>';
        foreach ($data as $dish) {
        echo '<tr>';
        echo sprintf('<th scope="row">%s</th>', $dish->getTitle());
        echo sprintf('<td>%s</td>', number_format($dish->getPrice(),2));
        echo sprintf('<td><img class="table-image" src="%s"></td>', $dish->getGalleryImage() ? $dish->getGalleryImage()->getImageURL() : ASSETS.DIRECTORY_SEPARATOR.'no-image.png');
        echo sprintf('<td>%s</td>', ($dish->getIsActive() ? $greenIcon : $redIcon));
        echo sprintf('<td><a href="/modifier-plat/%s">%s</a><a href="/delete-dish/%s">%s</a></td>', $dish->getId(), $linkIcon,$dish->getId(), $binIcon);
        echo '</tr>';
        }?>
