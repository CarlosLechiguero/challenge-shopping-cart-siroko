<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\Repository;

use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;

interface ShoppingCartRepository
{
    public function save(ShoppingCart $cart): void;

    public function find(CartId $cartId): ?ShoppingCart;
}
