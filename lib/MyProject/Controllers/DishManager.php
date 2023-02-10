<?php

namespace MyProject\Controller;

use MyProject\Model\Dish;
use MyProject\Model\GalleryImage;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Query\ResultSetMapping;

class DishManager {

    private EntityManager $em;

    public function index()
    {
        $dishRepository = $this->em->getRepository('MyProject\\Model\\Dish');
        echo 'salut';
        $dishes = $dishRepository->findAll();
        var_dump($dishes);
        ?>
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
        foreach ($dishes as $dish) {
        echo '<tr>';
        echo sprintf('<th scope="row">%s</th>', $dish->getTitle());
        echo sprintf('<td>%s</td>', number_format($dish->getPrice(),2));
        echo sprintf('<td><img src="%s" height="30px"></td>', $dish->getGalleryImage() ? $dish->getGalleryImage()->getImageURL() : '');
        echo sprintf('<td>%s</td>', ($dish->getIsActive() ? $greenIcon : $redIcon));
        echo sprintf('<td><a href="/modify-dish/%s">%s</td></a>', $dish->getId(), $linkIcon);
        echo '</tr>';
        }
    }

    public function modify(string $id)
    {
        $dishRepository = $this->em->getRepository('MyProject\\Model\\Dish');
        $dish = $dishRepository->find($id);
        echo $dish->getTitle();
        require_once(MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'dishForm.php');
    }

    public function create()
    {
        require_once(MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'dishForm.php');
    }

    public function confirm()
    {
        require_once(MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'addDishConfirmation.php');
    }

    public function addDishToDB($data)
    {
        $dish = new Dish();
        $dish->setTitle($data['title']);
        $dish->setPrice($data['price']);
        $dish->setIsActive($data['isActive']);
        if (($data['galleryImage'])) {
            $galleryImage = new GalleryImage;
            $galleryImage->setImageURL($data['galleryImage']);
            $galleryImage->setIsActive(false);
            $dish->setGalleryImage($galleryImage);
        }
        else {
            $galleryImage = null;
            $dish->setGalleryImage($galleryImage);
        }
        $this->em->persist($dish);    
        if($data['galleryImage']) {
            $this->em->persist($galleryImage);
        }
        $this->em->flush();
        header("Location:/creer-plat");
        die();
    }
    


    /**
     * Get the value of em
     */ 
    public function getEm()
    {
        return $this->em;
    }

    /**
     * Set the value of em
     *
     * @return  self
     */ 
    public function setEm($em)
    {
        $this->em = $em;

        return $this;
    }
}