<?php

namespace MyProject\Controller;

use MyProject\Model\Dish;
use MyProject\Model\GalleryImage;
use MyProject\View\ViewManager;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Query\ResultSetMapping;

class DishManager {

    private EntityManager $em;

    public function index()
    {
        $dishRepository = $this->em->getRepository('MyProject\\Model\\Dish');
        
        $dishes = $dishRepository->findAll();
        $viewmanager = new ViewManager;
        $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR."Views".DIRECTORY_SEPARATOR."dishListView.php";
        $viewmanager->render($view, $dishes);
        die();
    }

    public function modify(string $id)
    {
        $dishRepository = $this->em->getRepository('MyProject\\Model\\Dish');
        $dish = $dishRepository->find($id);
        $data = [$dish];
        $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'dishForm.php';
        $viewmanager = new ViewManager;
        $viewmanager->render($view, $data);
    }

    public function create()
    {
        $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'addDish.php';
        $viewmanager = new ViewManager;
        $viewmanager->render($view);
    }

    public function confirm()
    {
        $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'addDishConfirmation.php';
        var_dump($view);
        $viewmanager = new ViewManager;
        $viewmanager->render($view);    }

    public function delete(string $id)
    {
        $dishRepository = $this->em->getRepository('MyProject\\Model\\Dish');
        $dish = $dishRepository->find($id);
        if ($dish->getGalleryImage()) {
            $this->em->remove($dish->getGalleryImage());
            unlink(ROOTDIR.'/public/'.$dish->getGalleryImage()->getImageURL());
        }
        $this->em->remove($dish);
        $this->em->flush();
    
        header("Location:/plats");
        die();
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