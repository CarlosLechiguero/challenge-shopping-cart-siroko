<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\Entity;

use DateTimeImmutable;
use Challenge\ShoppingCartContext\Domain\ValueObject\OrderId;
use Challenge\ShoppingCartContext\Domain\ValueObject\AmountValue;

final readonly class OrderShoppingCart
{
    public function __construct(
        public OrderId $id,
        public ShoppingCart $cart,
        public AmountValue $amount,
        public DateTimeImmutable $createdAt = new DateTimeImmutable(),
    ) {

    }

}
