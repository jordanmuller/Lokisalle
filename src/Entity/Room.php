<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Room
{
    public const CATEGORIES = ['meeting', 'training', 'office'];

    public const CAT_TRANS = [
        'meeting' => 'Réunion',
        'training' => 'Formation',
        'office' => 'Bureau'
    ];

    public const CITIES = ['Paris', 'Lyon', 'Marseille'];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("getRoom")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     * @Groups("getRoom")
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("getRoom")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("getRoom")
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups("getRoom")
     */
    private $country = 'France';

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups("getRoom")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=80)
     * @Groups("getRoom")
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     * @Groups("getRoom")
     */
    private $postalCode;

    /**
     * @ORM\Column(type="smallint")
     * @Groups("getRoom")
     */
    private $capacity;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups("getRoom")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Opinion", mappedBy="room")
     */
    private $opinions;

    public function __construct()
    {
        $this->opinions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;
        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        if (in_array($category, self::CATEGORIES)) {
            $this->category = $category;
        }
        return $this;
    }

    public function getOpinions(): ?PersistentCollection
    {
        return $this->opinions;
    }

    public function getAvgMarks(): ?int
    {
        $opinions = $this->opinions->toArray();
        $count = count($opinions);
        $sum = 0;
        foreach ($opinions as $opinion) {
            $sum += $opinion->getMark();
        }
        return (0 !== $count)
            ? (int) round($sum/$count)
            : null;
    }
}
