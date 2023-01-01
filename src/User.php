<?php

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User{

    /** @var int */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int|null $id = null;
    
    /** @var string */
    #[ORM\Column(type: 'string')]
    private $surname;

    /** @var string */
    #[ORM\Column(type: 'string')]
    private $firstname;

    /** @var string */
    #[ORM\Column(type: 'string')]
    private $phoneNumber;

    /** @var string */
    #[ORM\Column(type: 'string')]
    private $email;

    /** @var string */
    #[ORM\Column(type: 'string')]
    private $password;

    private $passwordHash;
    private $bans;

}