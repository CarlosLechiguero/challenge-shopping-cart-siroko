<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\Entity;

use DateTimeImmutable;
use Challenge\ShoppingCartContext\Domain\ValueObject\OrderId;
use Challenge\ShoppingCartContext\Domain\ValueObject\AmountValue;

final class OrderShoppingCart
{
    private array $items;

    public function __construct(
        public readonly OrderId $id,
        public readonly ShoppingCart $cart,
        public readonly AmountValue $amount,
        public readonly DateTimeImmutable $createdAt = new DateTimeImmutable(),
    ) {
        $this->items = $cart->items();
    }

}
