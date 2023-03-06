<?php

namespace MyProject\Controller;

use MyProject\View\ViewManager;
use MyProject\View\GalleryImage;
use Doctrine\ORM\EntityManager;

class MainManager
{
    private EntityManager $em;
    
    public function home()
    {
        $imageRepository = $this->em->getRepository('MyProject\\Model\\GalleryImage');
        $images = $imageRepository->findBy(['isActive' => true]);
        $view = new ViewManager();
        $view->render('home.php', $images);
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