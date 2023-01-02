<?php

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
#[ORM\Table(name: 'bookings')]

class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface|string $id;

    /** @var string */
    #[ORM\Column(type: 'string')]
    private string $title;

    /** @var DateTime */
    #[ORM\Column(type: 'datetime')]
    private DateTime $slot;
    
    /** @var int */
    #[ORM\Column(type: 'integer')]
    private int $peopleNumber;

    /** @var string */
    #[ORM\Column(type: 'string')]
    private string $allergies;


    /**
     * Get the value of slot
     */ 
    public function getSlot()
    {
        return $this->slot;
    }

    /**
     * Set the value of slot
     *
     * @return  self
     */ 
    public function setSlot($slot)
    {
        $this->slot = $slot;

        return $this;
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
     * Get the value of peopleNumber
     */ 
    public function getPeopleNumber()
    {
        return $this->peopleNumber;
    }

    /**
     * Set the value of peopleNumber
     *
     * @return  self
     */ 
    public function setPeopleNumber($peopleNumber)
    {
        $this->peopleNumber = $peopleNumber;

        return $this;
    }

    /**
     * Get the value of allergies
     */ 
    public function getAllergies()
    {
        return $this->allergies;
    }

    /**
     * Set the value of allergies
     *
     * @return  self
     */ 
    public function setAllergies($allergies)
    {
        $this->allergies = $allergies;

        return $this;
    }
}