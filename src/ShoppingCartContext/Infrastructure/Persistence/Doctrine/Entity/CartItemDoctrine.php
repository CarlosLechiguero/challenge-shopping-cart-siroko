<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "cart_items")]
class CartItemDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;

    public function __construct(

        #[ORM\Column(type: Types::STRING, length: 36)]
        public readonly string $productId,

        #[ORM\Column(type: Types::INTEGER)]
        private int $quantity,

        #[ORM\ManyToOne(targetEntity: ShoppingCartDoctrine::class, inversedBy: "items")]
        #[ORM\JoinColumn(name: "cart_id", referencedColumnName: "id")]
        public readonly ShoppingCartDoctrine $cart,
    ) {}

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
}
