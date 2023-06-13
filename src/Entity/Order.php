<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;


    #[ORM\Column(length: 255)]
    private ?string $delivery_address = null;

    #[ORM\ManyToOne(inversedBy: 'order')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\OneToMany(mappedBy: 'orders', targetEntity: OrderDetail::class)]
    private Collection $order_detail;

    public function __construct()
    {
        $this->order_detail = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }


    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }


    public function getDeliveryAddress(): ?string
    {
        return $this->delivery_address;
    }

    public function setDeliveryAddress(string $delivery_address): static
    {
        $this->delivery_address = $delivery_address;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection<int, orderdetail>
     */
    public function getOrderDetail(): Collection
    {
        return $this->order_detail;
    }

    public function addOrderDetail(orderdetail $orderDetail): static
    {
        if (!$this->order_detail->contains($orderDetail)) {
            $this->order_detail->add($orderDetail);
            $orderDetail->setOrders($this);
        }

        return $this;
    }

    public function removeOrderDetail(orderdetail $orderDetail): static
    {
        if ($this->order_detail->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getOrders() === $this) {
                $orderDetail->setOrders(null);
            }
        }

        return $this;
    }
}
