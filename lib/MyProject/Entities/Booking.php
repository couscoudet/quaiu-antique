<?php

namespace MyProject\Model;

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
    
    /** @var int */
    #[ORM\Column(type: 'integer')]
    private int $peopleNumber;

    /** @var string */
    #[ORM\Column(type: 'string')]
    private string $allergies = '';

    /** @var string */
    #[ORM\Column(type: 'string')]
    private string $infos = '';

    /** @var Visitor */
    #[ORM\ManyToOne(targetEntity: Visitor::class)]
    #[ORM\JoinColumn(name: 'booked_by_id', referencedColumnName: 'id')]
    private Visitor $visitor ;

    /** @var Availability */
    #[ORM\ManyToOne(targetEntity: Availability::class)]
    #[ORM\JoinColumn(name: 'booked_on_id', referencedColumnName: 'id')]
    private Availability $availability;



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

    /**
     * Get the value of visitor
     */ 
    public function getVisitor()
    {
        return $this->visitor;
    }

    /**
     * Set the value of visitor
     *
     * @return  self
     */ 
    public function setVisitor(Visitor $visitor)
    {
        $this->visitor = $visitor;

        return $this;
    }

    /**
     * Get the value of availability
     */ 
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * Set the value of availability
     *
     * @return  self
     */ 
    public function setAvailability($availability)
    {
        $this->availability = $availability;

        return $this;
    }
}