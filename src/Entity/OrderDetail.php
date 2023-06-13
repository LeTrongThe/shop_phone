<?php

namespace App\Entity;

use App\Repository\OrderDetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderDetailRepository::class)]
class OrderDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?int $total_price = null;

    #[ORM\ManyToOne(inversedBy: 'order_detail')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $orders = null;

    #[ORM\ManyToOne(inversedBy: 'orderdetail')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $pro = null;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->total_price;
    }

    public function setTotalPrice(int $total_price): static
    {
        $this->total_price = $total_price;

        return $this;
    }

    public function getOrders(): ?Order
    {
        return $this->orders;
    }

    public function setOrders(?Order $orders): static
    {
        $this->orders = $orders;

        return $this;
    }

    public function getPro(): ?Product
    {
        return $this->pro;
    }

    public function setPro(?Product $pro): static
    {
        $this->pro = $pro;

        return $this;
    }


}
