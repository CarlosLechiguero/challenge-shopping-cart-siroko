<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\ValueObject;

use Ramsey\Uuid\Uuid;
use Challenge\ShoppingCartContext\Domain\Exception\InvalidIdException;

final class OrderId
{
    public function __construct(
        public readonly string $value
    ) {
        if (!Uuid::isValid($value)) {
            throw new InvalidIdException('Invalid OrderId UUID');
        }
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4()->toString());
    }
}
