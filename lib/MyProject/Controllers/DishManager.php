<?php

namespace MyProject\Controller;

use MyProject\Model\Dish;
use MyProject\Model\GalleryImage;
use MyProject\Model\Category;
use MyProject\View\ViewManager;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Query\ResultSetMapping;

require_once(__DIR__.'/../services/security.php');

class DishManager {

    private EntityManager $em;

    public function index()
    {
        $dishRepository = $this->em->getRepository('MyProject\\Model\\Dish');
        
        $dishes = $dishRepository->findAll();
        $viewmanager = new ViewManager;
        $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR."Views".DIRECTORY_SEPARATOR."dishListView.php";
        $viewmanager->renderAdmin($view, $dishes);
    }

    public function modify($id=null)
    {
        $dishRepository = $this->em->getRepository('MyProject\\Model\\Dish');
        if(!isset($_POST['dishId'])) {
            $dish = $dishRepository->find($id);
            $data = [$dish];
            $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'dishForm.php';
            $viewmanager = new ViewManager;
            $viewmanager->renderAdmin($view, $data);
        }
        else {
            if (checkIfAdmin()) 
            {
                $data = [
                'id' => secure($_POST['dishId']),
                'title' => secure($_POST['dishTitle']),
                'price' => secure($_POST['dishPrice']),
                'isActive' => isset($_POST['activeDish']) ? secure($_POST['activeDish']) : false
                ];
                $dish = $dishRepository->find(secure($_POST['dishId']));
                $dish->hydrate($data);
                $this->em->flush();
                header("Location:/plats");
            }
        }
    }

    public function create()
    {
        $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'addDish.php';
        $viewManager = new ViewManager;
        $categoryRepository = $this->em->getRepository('MyProject\\Model\\Category');
        $categories = $categoryRepository->findAll();
        $viewManager->renderAdmin($view, $categories);
    }

    public function confirm()
    {
        $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'addDishConfirmation.php';
        $viewmanager = new ViewManager;
        $viewmanager->renderAdmin($view);    }

    public function delete(string $id)
    {
        if (checkIfAdmin()) {
            $dishRepository = $this->em->getRepository('MyProject\\Model\\Dish');
            $dish = $dishRepository->find($id);
            if ($dish->getGalleryImage()) {
                require_once(MYPROJECT_DIR.DIRECTORY_SEPARATOR.'services/aws.php');
                if (isset(explode('.com/',$dish->getGalleryImage()->getImageURL())[1])) {
                    $key = explode('.com/',$dish->getGalleryImage()->getImageURL())[1];
                    try {
                        $result = $s3->deleteObject([
                            'Bucket' => $bucket,
                            'Key' => $key
                        ]);
                    }
                    catch(S3Exception $e){
                            exit("Erreur : " . $e->getAwsErrorMessage() . PHP_EOL);
                    }
                }
                $this->em->remove($dish->getGalleryImage());
                $this->em->remove($dish);
                $this->em->flush();
                header("Location:/plats");
            }
            else {
                $this->em->remove($dish);
                $this->em->flush();
                header("Location:/plats");
            }
        }
        else {
            exit('Vous n\'êtes pas autorisé à consulter cette page<br>
                <a href="/">Retourner à l\'accueil</a>');
        }
    }

    public function addDishToDB(array $data)
    {
        if (checkIfAdmin()) {
            $dish = new Dish();
            $categoryRepository = $this->em->getRepository('MyProject\\Model\\Category');
            $category = $categoryRepository->findOneBy(['name' => secure($data['category'])]);
            $dish->setTitle(secure($data['title']));
            $dish->setPrice(secure($data['price']));
            $dish->setIsActive(secure($data['isActive']));
            $dish->setCategory($category);
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
    }

    public function galleryManager()
    {
        $imageRepository = $this->em->getRepository('MyProject\\Model\\GalleryImage');
        $images = $imageRepository->findAll();
        $viewManager = new ViewManager;
        $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'galleryManagerView.php';
        $viewManager->renderAdmin($view, $images);
    }
    
    public function removeImageFromGallery(int $id)
    {
        if (checkIfAdmin()) {
            try
            {
                $imageRepository = $this->em->getRepository('MyProject\\Model\\GalleryImage');
                $image = $imageRepository->find($id);
                $image->setIsActive(false);
                $this->em->flush();
                echo '<i role="button" style="font-size: 2rem;" id="'.$image->getId().'" class="bi bi-plus-square addToGallery"></i>';
            }
            catch (Exception $e) {
                echo $e;
            }
        }
    }

    public function addImageToGallery($id)
    {
        if (checkIfAdmin()) {
            try
            {
                $imageRepository = $this->em->getRepository('MyProject\\Model\\GalleryImage');
                $image = $imageRepository->find($id);
                $image->setIsActive(true);
                $this->em->flush();
                echo '<i role="button" style="font-size: 2rem;" id="'.$image->getId().'" class="bi bi-dash-square removeFromGallery"></i>';
            }
            catch (Exception $e) {
                echo $e;
            }
        }
    }

    public function displayCard() {
        $viewManager = new ViewManager;
        $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'displayCard.php';
        $dishRepository = $this->em->getRepository('MyProject\\Model\\Dish');
        $dishes = $dishRepository->findBy(['isActive' => true]);
        $viewManager->render($view, $dishes);
    }

    public function addCategory() {
        if (isset($_POST['category'])) {
            $category = new Category;
            $category->setName(secure($_POST['category']));
            $categoryRepository = $this->em->getRepository('MyProject\\Model\\Category');
            $categoryCount = $categoryRepository->count([]);
            $category->setCatOrder($categoryCount + 1);
            $this->em->persist($category);
            $this->em->flush();
            header("Location: /ajouter-categorie");
        }
        else {
            $viewManager = new ViewManager;
            $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'addCategory.php';
            $categoryRepository = $this->em->getRepository('MyProject\\Model\\Category');
            $categories = $categoryRepository->findBy(array(), array('catOrder' => 'ASC'));
            $viewManager->renderAdmin($view,$categories);
        }
    }

    public function orderCategories($orderedCategories)
    {
        if (checkIfAdmin()) {
            try{
                $categoryRepository = $this->em->getRepository('MyProject\\Model\\Category');
                foreach($orderedCategories as $index => $categoryName){
                    $category = $categoryRepository->findOneBy( ['name' => $categoryName]);
                    $category->setCatOrder($index);
                }
                $this->em->flush();
            }
            catch(Exception $e){
                exit($e);
            }
        }
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