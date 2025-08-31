<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\DTO;

class ShoppingCartDto
{
    public function __construct(
        public readonly string $cartId,
        public readonly string $productId,
        public readonly int $quantity,
    ) {
    }
}
