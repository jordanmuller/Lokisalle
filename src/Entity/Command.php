<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandRepository")
 */
class Command
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $registeredDate;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Product")
     */
    private $product;

    public function __construct()
    {
        $this->registeredDate = new \Datetime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegisteredDate(): ?\DateTimeInterface
    {
        return $this->registeredDate;
    }

    public function setRegisteredDate(\DateTimeInterface $registeredDate): self
    {
        $this->registeredDate = $registeredDate;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }
}
