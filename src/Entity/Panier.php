<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Ignore;


#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $p_date = null;

    #[ORM\Column(nullable: true)]
    private ?float $total_price = null;

    #[ORM\ManyToOne]
    #[Ignore]
    private ?User $User = null;

    #[ORM\OneToMany(mappedBy: 'panier', targetEntity: MotosPanier::class ,  orphanRemoval: true)]
    #[Ignore]
    private Collection $MotosPaniers;

    public function __construct()
    {
        $this->MotosPaniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPDate(): ?\DateTimeInterface
    {
        return $this->p_date;
    }

    public function setPDate(?\DateTimeInterface $p_date): self
    {
        $this->p_date = $p_date;

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

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection<int, MotosPanier>
     */
    public function getMotosPaniers(): Collection
    {
        return $this->MotosPaniers;
    }

    public function addMotosPanier(MotosPanier $motosPanier): self
    {
        if (!$this->MotosPaniers->contains($motosPanier)) {
            $this->MotosPaniers->add($motosPanier);
            $motosPanier->setPanier($this);
        }

        return $this;
    }

    public function removeMotosPanier(MotosPanier $motosPanier): self
    {
        if ($this->MotosPaniers->removeElement($motosPanier)) {
            // set the owning side to null (unless already changed)
            if ($motosPanier->getPanier() === $this) {
                $motosPanier->setPanier(null);
            }
        }

        return $this;
    }
}