<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\DTO;

class CartIdDto
{
    public function __construct(
        public readonly string $cartId,
    ) {
    }
}
