<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\ValueObject;

use Ramsey\Uuid\Uuid;

final class CartId
{
    public function __construct(
        private readonly string $value
    ) {
        if (!Uuid::isValid($value)) {
            throw new \InvalidArgumentException('Invalid CartId UUID');
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(CartId $other): bool
    {
        return $this->value === $other->value;
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4()->toString());
    }
}
