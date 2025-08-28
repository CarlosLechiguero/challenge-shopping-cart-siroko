<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\DTO;

class DeleteItemDto
{
    public function __construct(
        public readonly string $cartId,
        public readonly string $productId,
    ) {
    }
}
