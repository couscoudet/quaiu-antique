
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
        $greenIcon = '<i style="color: green;" class="bi bi-bookmark-check"></i>';
        $redIcon = '<i style="color: red;" class="bi bi-bookmark-x""></i>';
        $linkIcon = '<i class="bi bi-pencil-square"></i>';
        foreach ($data as $dish) {
        echo '<tr>';
        echo sprintf('<th scope="row">%s</th>', $dish->getTitle());
        echo sprintf('<td>%s</td>', number_format($dish->getPrice(),2));
        echo sprintf('<td><img class="table-image" src="%s"></td>', $dish->getGalleryImage() ? $dish->getGalleryImage()->getImageURL() : '');
        echo sprintf('<td>%s</td>', ($dish->getIsActive() ? $greenIcon : $redIcon));
        echo sprintf('<td><a href="/modify-dish/%s">%s</td></a>', $dish->getId(), $linkIcon);
        echo '</tr>';
        }?>
