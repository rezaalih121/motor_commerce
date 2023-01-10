<?php

namespace App\Entity;

use App\Repository\MotosPanierRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;
#[ORM\Entity(repositoryClass: MotosPanierRepository::class)]
class MotosPanier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $quntity = null;

    #[ORM\Column(nullable: true)]
    private ?float $total_price = null;

    #[ORM\ManyToOne]
    #[Ignore]
    private ?Motos $Motos = null;

    #[ORM\ManyToOne]
    #[Ignore]
    private ?Panier $Panier = null;

    #[ORM\ManyToOne(inversedBy: 'MotosPaniers' )]
    #[Ignore]
    private ?Panier $panier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuntity(): ?int
    {
        return $this->quntity;
    }

    public function setQuntity(?int $quntity): self
    {
        $this->quntity = $quntity;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->total_price;
    }

    public function setTotalPrice(?float $total_price): self
    {
        $this->total_price = $total_price;

        return $this;
    }

    public function getMotos(): ?Motos
    {
        return $this->Motos;
    }

    public function setMotos(?Motos $Motos): self
    {
        $this->Motos = $Motos;

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->Panier;
    }

    public function setPanier(?Panier $Panier): self
    {
        $this->Panier = $Panier;

        return $this;
    }
}