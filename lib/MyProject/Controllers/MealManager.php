<?php

namespace MyProject\Controller;
use MyProject\Model\Meal;
use MyProject\View\ViewManager;
use Doctrine\ORM\EntityManager;


class MealManager
{
    private EntityManager $em;

    public function createMeal($data = null) 
    {
        //si je n'ai pas de $_POST, afficher le formulaire
        if (!$data) {
            $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'create-menu-view.php';
            $dishRepository = $this->em->getRepository('MyProject\\Model\\Dish');
            $dishes = $dishRepository->findAll();
            $viewManager = new ViewManager;
            $viewManager->renderAdmin($view,$dishes);
        }
        else {
            $meal = new Meal($this->em);
            $meal->setTitle($data['title']);
            $meal->setComments($data['comments']);
            foreach ($data['dishes'] as $dishId) {
                $mealRepository = $this->em->getRepository('MyProject\\Model\\Dish');
                $dish = $mealRepository->find($dishId);
                if (isset($dish)) {
                    $meal->addDish($dish);
                }
            }
            try {
                $meal->save();
                header('Location:/');
            }
            catch(Exception $e) {
                exit('<span>erreur : <span><br>' + $e);
            }
            
        }
        //sinon utiliser les données pour créer un menu 
    }

    public function mealsList()
    {
        $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'meals-list-view.php';
        $mealRepository = $this->em->getRepository('MyProject\\Model\\Meal');
        $meals = $mealRepository->findAll();
        $viewManager = new ViewManager;
        $viewManager->renderAdmin($view,$meals);
    }

    public function deleteMeal($mealId = null)
    {
        session_start();
        if ($mealId && isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            try {
                $mealRepository = $this->em->getRepository('MyProject\\Model\\Meal');
                $meal = $mealRepository->find($mealId);
                $this->em->remove($meal);
                $this->em->flush();
                header('Location: /liste-menus');
            }
            catch(Exception $e){
                exit($e);
            }
        }
        else {
            header('Location: /');
        }
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