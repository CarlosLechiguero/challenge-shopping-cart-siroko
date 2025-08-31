<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\ValueObject;

use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;

final class DeleteProductValue
{
    public function __construct(
        public CartId $cartId,
        public ProductId $productId
    ) {}
}
