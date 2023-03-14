<?php

namespace MyProject\Model;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'meals')]

class Meal
{
        // ...

    /**
     * Many Meals have Many Dishes.
     * @var Collection<int, Group>
     */

    private $entityManager;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface|string $id;

    #[ORM\Column(type: 'string')]
    private string $title;

    #[ORM\Column(type: 'string')]
    private string $comments;

    #[ORM\JoinTable(name: 'meals_dishers')]
    #[ORM\JoinColumn(name: 'meal_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'dish_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: Dish::class)]
    private Collection $dishes;

    public function __construct(EntityManager $entityManager) 
    {
        $this->dishes = new ArrayCollection();
        $this->entityManager = $entityManager;
    }

    public function addDish($dish)
    {
        if(!$this->dishes->contains($dish)){
            $this->dishes->add($dish);
        }
    }

    public function removeDish($dish)
    {
        if($this->dishes->contains($dish)){
            $this->dishes->removeElement($dish);
        }
    }

    //save with only existing dishes
    public function save(): void
    {
        $this->entityManager->persist($this);
        $this->entityManager->flush();
    }


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
     * Get the value of comments
     */ 
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set the value of comments
     *
     * @return  self
     */ 
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }
}