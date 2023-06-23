<?php

namespace App\Entity;

use App\Repository\SupplierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SupplierRepository::class)]
class Supplier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\OneToMany(mappedBy: 'supplier', targetEntity: product::class)]
    private Collection $pro;

    public function __construct()
    {
        $this->pro = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, product>
     */
    public function getPro(): Collection
    {
        return $this->pro;
    }

    public function addPro(product $pro): static
    {
        if (!$this->pro->contains($pro)) {
            $this->pro->add($pro);
            $pro->setSupplier($this);
        }

        return $this;
    }

    public function removePro(product $pro): static
    {
        if ($this->pro->removeElement($pro)) {
            // set the owning side to null (unless already changed)
            if ($pro->getSupplier() === $this) {
                $pro->setSupplier(null);
            }
        }

        return $this;
    }
}
