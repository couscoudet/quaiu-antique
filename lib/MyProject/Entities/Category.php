<?php

namespace MyProject\Model;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
#[ORM\Table(name: 'categories')]

class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface|string $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'integer')]
    private int $catOrder;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of dish
     */ 
    public function getDish()
    {
        return $this->dish;
    }

    /**
     * Set the value of dish
     *
     * @return  self
     */ 
    public function setDish($dish)
    {
        $this->dish = $dish;

        return $this;
    }



    /**
     * Get the value of catOrder
     */ 
    public function getCatOrder()
    {
        return $this->catOrder;
    }

    /**
     * Set the value of catOrder
     *
     * @return  self
     */ 
    public function setCatOrder($catOrder)
    {
        $this->catOrder = $catOrder;

        return $this;
    }
}
