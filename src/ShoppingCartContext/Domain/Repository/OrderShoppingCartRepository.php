<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\Repository;

use Challenge\ShoppingCartContext\Domain\Entity\OrderShoppingCart;

interface OrderShoppingCartRepository
{
    public function checkout(OrderShoppingCart $orderShoppingCart): void;
}
