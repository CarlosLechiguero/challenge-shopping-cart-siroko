<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Query;

use Challenge\SharedContext\Application\Query\Query;
use Challenge\ShoppingCartContext\Domain\Entity\OrderShoppingCart;

final class CheckoutShoppingCartQuery extends Query
{
    public function __construct(
       public readonly OrderShoppingCart $orderShoppingCart,
    ) {
    }
}
