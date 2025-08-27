<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Response;

use Challenge\SharedContext\Application\Response\AbstractResponse;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;

final class DeleteItemShoppingCartResponse extends AbstractResponse
{
    public function getResponse(): array
    {
        return [
            "message" => "Delete product succefully"
        ];
    }
}
