<?php

namespace MyProject\Model;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
#[ORM\Table(name: 'arrangements')]
class Arrangement 
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface|string $id;
    
    #[ORM\Column(type: 'string')]
    private string $title;
    
    #[ORM\Column(type: 'string')]
    private string $description;

    #[ORM\Column(type: 'float')]
    private float $price;

    #[ORM\ManyToOne(targetEntity: Meal::class)]
    #[ORM\JoinColumn(name: 'meal_id', referencedColumnName: 'id')]
    private Meal $meal;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of meal
     */ 
    public function getMeal()
    {
        return $this->meal;
    }

    /**
     * Set the value of meal
     *
     * @return  self
     */ 
    public function setMeal($meal)
    {
        $this->meal = $meal;

        return $this;
    }
}