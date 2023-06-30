<?php
namespace App\Entity;
use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\OneToMany(mappedBy: 'brand', targetEntity: Product::class)]
    private Collection $pro;

    public function __construct()
    {
        $this->pro = new ArrayCollection(); }
    public function getId(): ?int
    {
        return $this->id; }
    public function getName(): ?string
    {
        return $this->name;}
    public function setName(string $name): static
    {
        $this->name = $name;
        return $this; }
    public function getAddress(): ?string
    {
        return $this->address; }
    public function setAddress(string $address): static
    {
        $this->address = $address;
        return $this; }
    public function __toString() {
        return $this->name; }
    /**
     * @return Collection<int, Product>
     */
    public function getPro(): Collection
    {
        return $this->pro; }
    public function addPro(Product $pro): static
    { if (!$this->pro->contains($pro)) {
            $this->pro->add($pro);
            $pro->setBrand($this);
        }
        return $this; }
    public function removePro(Product $pro): static
    { if ($this->pro->removeElement($pro)) {
            // set the owning side to null (unless already changed)
            if ($pro->getBrand() === $this) {
                $pro->setBrand(null);
            }
        }
        return $this;
    }
}
