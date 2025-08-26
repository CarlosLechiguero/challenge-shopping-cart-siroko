<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\Entity;

use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;

final class CartItem
{
    public function __construct(
        public readonly ProductId $productId,
        private QuantityValue $quantity
    ) {
    }

    public function getQuantity(): QuantityValue
    {
        return $this->quantity;
    }

    public function increaseQuantity(QuantityValue $quantity): void
    {
        $this->quantity = $this->quantity->increase($quantity->getQuantity());
    }
}
