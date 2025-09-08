<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\ValueObject;

use Challenge\ShoppingCartContext\Domain\Exception\InvalidAmountException;

final class AmountValue
{
    public function __construct(
        public readonly float $value
    ) {
        if ($value < 0) {
            throw new InvalidAmountException('Amount must be non-negative.');
        }
    }
}
