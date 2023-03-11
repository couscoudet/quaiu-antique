<?php

namespace MyProject\Model;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
class Admin extends User
{
    protected $role = 'admin';
}