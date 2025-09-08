<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\ValueObject;

use Ramsey\Uuid\Uuid;
use Challenge\ShoppingCartContext\Domain\Exception\InvalidIdException;

final class ProductId
{
    public function __construct(
        public readonly string $value
    ) {
        if (!Uuid::isValid($value)) {
            throw new InvalidIdException('Invalid ProductId UUID');
        }
    }

    public function equals(ProductId $other): bool
    {
        return $this->value === $other->value;
    }
}
