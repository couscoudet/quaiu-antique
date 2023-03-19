<?php

namespace MyProject\Controller;

use MyProject\Model\Visitor;
use MyProject\Model\User;
use MyProject\Model\Admin;
use MyProject\Model\Customer;
use Doctrine\ORM\EntityManager;
use MyProject\View\ViewManager;

require_once(__DIR__.'/../services/security.php');

class UserManager
{
    private EntityManager $em;

    public function addVisitor(string $email)
    {
        $visitor = new Visitor;
        $visitor->setEmail(checkIfMail($email));
        $this->em->persist($visitor);
        $this->em->flush();
    }

    public function logUser(array|null $data=null)
    {
        if(!isset($_POST['data'])){
            $viewManager = new ViewManager;
            $viewManager->render('login.php');
        }
        else {
            $user = $this->find(($_POST['data']['email']));
            if (!$user){
                exit('<p>Cet utilisateur n\'existe pas</p><br>
                      <a href="/login"> Revenir à la page de login</a>');
            }
            else {
                if (password_verify(($_POST['data']['password']),$user->getPassword())) {
                    session_start();
                    $_SESSION["user"] = $user;
                    header("Location: /");             
                }
                else {
                    exit('<p>Mot de passe erroné</p><br>
                      <a href="/login"> Revenir à la page de login</a>');
                }
            }
        }
    }

    public function logOutUser() {
        session_start();
        $_SESSION = [];
        header("Location: /");
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
            $this->em->persist($user);

            $this->em->flush();
        }
    }

    public function addAdmin(array|null $data=null)
    {
        if(!isset($_POST['data'])){
            $viewManager = new ViewManager;
            $viewManager->renderAdmin('addAdmin.php');
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

    public function find($email) 
    {
        try {
            $userRepository = $this->em->getRepository('MyProject\\Model\\User');
            $user = $userRepository->findOneBy(['email' => secure(checkIfMail($email))]);
            return ($user);
        }
        catch(Doctrine_Manager_Exception $e) {
            exit('erreur : '. $e);
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