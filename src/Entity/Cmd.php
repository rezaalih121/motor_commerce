<?php

namespace App\Entity;

use App\Repository\CmdRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CmdRepository::class)]
class Cmd
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $c_date = null;

    #[ORM\Column(nullable: true)]
    private ?float $c_totalPrice = null;

    #[ORM\Column(nullable: true)]
    private ?bool $payee = null;

    #[ORM\Column(nullable: true)]
    private ?bool $retrait = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Panier $Panier = null;

    #[ORM\ManyToOne]
    private ?User $User = null;

    #[ORM\ManyToOne]
    private ?Address $addressFact = null;

    #[ORM\ManyToOne]
    private ?Address $addressLiv = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCDate(): ?\DateTimeInterface
    {
        return $this->c_date;
    }

    public function setCDate(?\DateTimeInterface $c_date): self
    {
        $this->c_date = $c_date;

        return $this;
    }

    public function getCTotalPrice(): ?float
    {
        return $this->c_totalPrice;
    }

    public function setCTotalPrice(?float $c_totalPrice): self
    {
        $this->c_totalPrice = $c_totalPrice;

        return $this;
    }

    public function isPayee(): ?bool
    {
        return $this->payee;
    }

    public function setPayee(?bool $payee): self
    {
        $this->payee = $payee;

        return $this;
    }

    public function isRetrait(): ?bool
    {
        return $this->retrait;
    }

    public function setRetrait(?bool $retrait): self
    {
        $this->retrait = $retrait;

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

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getAddressFact(): ?Address
    {
        return $this->addressFact;
    }

    public function setAddressFact(?Address $addressFact): self
    {
        $this->addressFact = $addressFact;

        return $this;
    }

    public function getAddressLiv(): ?Address
    {
        return $this->addressLiv;
    }

    public function setAddressLiv(?Address $addressLiv): self
    {
        $this->addressLiv = $addressLiv;

        return $this;
    }
}