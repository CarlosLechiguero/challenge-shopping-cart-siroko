<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
#[ORM\Table(name: "shopping_carts")]
class ShoppingCartDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    public readonly int $id;
        
    public function __construct(


        #[ORM\Column(type: Types::STRING, length: 36, unique: true)]
        public readonly string $cartId,

        #[ORM\OneToMany(
            targetEntity: CartItemDoctrine::class,
            mappedBy: "cart",
            cascade: ["persist", "remove"],
            orphanRemoval: true,
        )]
        private Collection $items = new ArrayCollection()
    ) {}

    /** @return Collection<int, CartItemDoctrine> */
    public function items(): Collection
    {
        return $this->items;
    }

    public function addItem(CartItemDoctrine $item): void
    {
        $this->items[] = $item;
    }
}
