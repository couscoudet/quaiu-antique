<?php

namespace MyProject\Model;

use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity]
class Customer extends User
{
    #[ORM\Column(type: 'string')]
    private string $allergies;

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