<?php

namespace MyProject\Controller;
use MyProject\Model\Meal;
use MyProject\Model\Arrangement;
use MyProject\View\ViewManager;
use Doctrine\ORM\EntityManager;

require_once(__DIR__.'/../services/security.php');

class MealManager
{
    private EntityManager $em;

    public function createMeal($data = null) 
    {
        //si je n'ai pas de $_POST, afficher le formulaire
        if (!$data) {
            $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'create-menu-view.php';
            $dishRepository = $this->em->getRepository('MyProject\\Model\\Dish');
            $dishes = $dishRepository->findBy(['isActive' => true]);
            $viewManager = new ViewManager;
            $viewManager->renderAdmin($view,$dishes);
        }
        else if (checkIfAdmin()) {
            $meal = new Meal($this->em);
            $meal->setTitle(secure($data['title']));
            $meal->setComments(secure($data['comments']));
            foreach ($data['dishes'] as $dishId) {
                $mealRepository = $this->em->getRepository('MyProject\\Model\\Dish');
                $dish = $mealRepository->find(secure($dishId));
                if (isset($dish)) {
                    $meal->addDish($dish);
                }
            }
            foreach ($data['arrangement'] as $mealArrangement) {
                $arrangement = new Arrangement($this->em);
                $arrangement->setTitle(secure($mealArrangement['title']));
                $arrangement->setDescription(secure($mealArrangement['description']));
                $arrangement->setPrice(secure($mealArrangement['price']));
                $arrangement->setMeal($meal);
                $this->em->persist($arrangement);
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
        if(checkIfAdmin()) {
            try {
                $mealRepository = $this->em->getRepository('MyProject\\Model\\Meal');
                $meal = $mealRepository->find(secure($mealId));
                $arrangementRepository = $this->em->getRepository('MyProject\\Model\\Arrangement');
                $arrangements = $arrangementRepository->findBy(['meal' => secure($mealId)]);
                foreach($arrangements as $arrangement) {
                    $this->em->remove($arrangement);
                }
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

    public function displayMeal() {
        $view = MYPROJECT_DIR.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'display-meals-view.php';
        try {
            $mealRepository = $this->em->getRepository('MyProject\\Model\\Meal');
            $meals = $mealRepository->findAll();
            $arrangementRepository = $this->em->getRepository('MyProject\\Model\\Arrangement');
            $arrangements = $arrangementRepository->findAll();
            $data = ['meals' => $meals, 'arrangements' =>  $arrangements];
            $viewManager = new ViewManager;
            $viewManager->render($view,$data);
        }
        catch(Exception $e){
            exit($e);
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