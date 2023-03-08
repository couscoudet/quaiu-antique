<?php

namespace MyProject\Model;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use MyProject\Model\GalleryImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'dishes')]

class Dish
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface|string $id;

    #[ORM\Column(type: 'string')]
    private string $title;

    #[ORM\Column(type: 'float')]
    private float $price;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive;

    #[ORM\JoinTable(name: 'dishes_tags')]
    #[ORM\JoinColumn(name: 'dish_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'tag_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: Tag::class)]
    private Collection $tags;

    public function __construct() {
        $this->tags = new ArrayCollection();
        $this->galleryImage = new GalleryImage();
    }

    #[ORM\OneToOne(targetEntity: GalleryImage::class)]
    #[ORM\JoinColumn(name: 'image_id', referencedColumnName: 'id', nullable: true)]
    private GalleryImage|null $galleryImage = null;

    public function hydrate($data) {
        foreach($data as $attribute => $value){
            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_','', $attribute)));
            if (is_callable(array($this,$method))) {
                $this->$method($value);
            }
        }
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
        $this->title = ucwords($title);

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
     * Get the value of isActive
     */ 
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set the value of isActive
     *
     * @return  self
     */ 
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get the value of tags
     */ 
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set the value of tags
     *
     * @return  self
     */ 
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get the value of galleryImage
     */ 
    public function getGalleryImage()
    {
        return $this->galleryImage;
    }

    /**
     * Set the value of galleryImage
     *
     * 
     */ 
    public function setGalleryImage(GalleryImage|null $galleryImage)
    {
        $this->galleryImage = $galleryImage;
    }
}