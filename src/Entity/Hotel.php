<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HotelRepository")
 */
class Hotel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * The internal primary identity key.
     *
     * @var UuidInterface
     *
     * @ORM\Column(type="uuid", unique=true)
     */
    protected $uuid;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="HotelChain", inversedBy="hotels")
     * @ORM\JoinColumn(name="hotel_chain_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $hotelChain;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Review", mappedBy="hotel", cascade={"persist", "remove"})
     */
    protected $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getHotelChain(): ?string
    {
        return $this->hotelChain;
    }

    public function setHotelChain($hotelChain): self
    {
        $this->hotelChain = $hotelChain;

        return $this;
    }

    public function getReviews()
    {
        return $this->reviews;
    }
    
    public function setReviews(array $reviews): self
    {
        $this->reviews = $reviews; 

        return $this;
    }
}
