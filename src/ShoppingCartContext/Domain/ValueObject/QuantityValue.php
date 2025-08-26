<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\ValueObject;

use Challenge\ShoppingCartContext\Domain\Exception\InvalidQuantityException;

final class QuantityValue
{
    
    public function __construct(
        private int $quantity
    ) {
        if ($quantity <= 0) {
            throw new InvalidQuantityException('Quantity must be greater than 0');
        }

        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function increase(int $increment): self
{
    return new self($this->quantity + $increment);
}

}
