<?php

namespace MyProject\Controller;

use MyProject\Model\Dish;
use MyProject\Model\GalleryImage;
use Doctrine\ORM\EntityManager;

class DishManager {

    private EntityManager $em;

    public function index()
    {
        echo 'liste des plats 2023';
    }

    public function show(int $id)
    {
        echo 'je suis le plat '.$id;
    }

    public function create()
    {
        require_once(MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'addDish.php');
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