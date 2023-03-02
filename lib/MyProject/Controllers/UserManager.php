<?php

namespace MyProject\Controller;

use MyProject\Model\Visitor;
use MyProject\Model\User;
use MyProject\Model\Admin;
use MyProject\Model\Customer;
use Doctrine\ORM\EntityManager;
use MyProject\View\ViewManager;

class UserManager
{
    private EntityManager $em;

    public function addVisitor(string $email)
    {
        $visitor = new Visitor;
        $visitor->setEmail($email);
        $this->em->persist($visitor);
        $this->em->flush();
    }

    public function logUser(array|null $data=null)
    {
        if(!isset($_POST['data'])){
            $viewManager = new ViewManager;
            $viewManager->render('login.php');
        }
    }

    public function addUser(array|null $data=null)
    {
        if(!isset($_POST['data'])){
            $viewManager = new ViewManager;
            $viewManager->render('addUser.php');
        }
        else {
            $user = new User;
            $user->hydrate($data);
            var_dump($user);
            $this->em->persist($user);

            $this->em->flush();
        }
    }

    public function addAdmin(array|null $data=null)
    {
        if(!isset($_POST['data'])){
            $viewManager = new ViewManager;
            $viewManager->render('addAdmin.php');
        }
        else {
            $user = new Admin;
            $user->hydrate($data);
            $this->em->persist($user);
            $this->em->flush();
            header("Location: /plats");
            exit();
        }
    }

    public function addCustomer(array $data)
    {
        $customer = new Customer;
        $customer->hydrate($data);
        $this->em->persist($customer);
        $this->em->flush();
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