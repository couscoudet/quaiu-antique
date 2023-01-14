<?php

namespace MyProject\Model;

use DateTime;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
#[ORM\Table(name: 'availabilities')]

class Availability 
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface|string $id;

    #[ORM\Column(type:'datetime')]
    private DateTime $startSlot;

    #[ORM\Column(type:'datetime')]
    private DateTime $endSlot;

    #[ORM\Column(type:'integer')]
    private int|null $peopleNumber;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of startSlot
     */ 
    public function getStartSlot()
    {
        return $this->startSlot;
    }

    /**
     * Set the value of startSlot
     *
     * @return  self
     */ 
    public function setStartSlot($startSlot)
    {
        $this->startSlot = $startSlot;

        return $this;
    }

    /**
     * Get the value of endSlot
     */ 
    public function getEndSlot()
    {
        return $this->endSlot;
    }

    /**
     * Set the value of endSlot
     *
     * @return  self
     */ 
    public function setEndSlot($endSlot)
    {
        $this->endSlot = $endSlot;

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
}

