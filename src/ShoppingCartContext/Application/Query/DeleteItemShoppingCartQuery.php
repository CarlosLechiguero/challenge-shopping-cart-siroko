<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Query;

use Challenge\SharedContext\Application\Query\Query;
use Challenge\ShoppingCartContext\Domain\ValueObject\DeleteProductValue;

final class DeleteItemShoppingCartQuery extends Query
{
    public function __construct(
        public readonly DeleteProductValue $deleteProductValue,
    ) {
        
    }
}
