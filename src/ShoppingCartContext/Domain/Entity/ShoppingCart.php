<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\Entity;

use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;

final class ShoppingCart
{

    public function __construct(
        public readonly CartId $id,
        private array $items = []
    ) {
    }

    /** @return CartItem[] */
    public function items(): array
    {
        return $this->items;
    }

    public function addItemEntity(CartItem $item): void
    {
        $this->items[] = $item;
    }

    public function removeItemEntity(CartItem $item): void
    {
        $this->items = array_filter(
            $this->items,
            fn (CartItem $i) => !$i->productId->equals($item->productId)
        );
    }
}
