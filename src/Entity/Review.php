<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use App\Entity\Hotel;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 */
class Review implements JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $hotel_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel", inversedBy="reviews")
     * @ORM\JoinColumn(name="hotel_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $hotel;

    public function jsonSerialize() : array
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'score' => $this->score,
        ];
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getHotelId(): int
    {
        return $this->hotel_id;
    }


    public function setHotelId($hotel_id)
    {
        $this->hotel_id = $hotel_id;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getHotel(): Hotel
    {
        return $this->hotel;
    }
    
    public function setHotel($hotel): self
    {
        $this->hotel = $hotel; 

        return $this;
    }
}
