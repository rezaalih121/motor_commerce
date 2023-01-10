<?php

namespace App\Entity;

use App\Repository\MotosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotosRepository::class)]
class Motos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $kilometre = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_imat = null;

    #[ORM\Column(nullable: true)]
    private ?float $power = null;

    #[ORM\ManyToOne]
    private ?Marque $Marque = null;

    public function __toString()
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
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

    public function getKilometre(): ?int
    {
        return $this->kilometre;
    }

    public function setKilometre(?int $kilometre): self
    {
        $this->kilometre = $kilometre;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDateImat(): ?\DateTimeInterface
    {
        return $this->date_imat;
    }

    public function setDateImat(?\DateTimeInterface $date_imat): self
    {
        $this->date_imat = $date_imat;

        return $this;
    }

    public function getPower(): ?float
    {
        return $this->power;
    }

    public function setPower(?float $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->Marque;
    }

    public function setMarque(?Marque $Marque): self
    {
        $this->Marque = $Marque;

        return $this;
    }
}