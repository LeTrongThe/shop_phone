<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'cate', targetEntity: Product::class)]
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getPro(): Collection
    {
        return $this->pro;
    }

    public function addPro(Product $pro): static
    {
        if (!$this->pro->contains($pro)) {
            $this->pro->add($pro);
            $pro->setCate($this);
        }

        return $this;
    }

    public function removePro(Product $pro): static
    {
        if ($this->pro->removeElement($pro)) {
            // set the owning side to null (unless already changed)
            if ($pro->getCate() === $this) {
                $pro->setCate(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->name;
    }

    
}
