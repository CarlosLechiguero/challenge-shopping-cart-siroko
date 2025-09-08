<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Service\Parser;

use Challenge\ShoppingCartContext\Application\DTO\CartIdDto;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;

class ListItemShoppingCartParser
{
    public function __invoke(CartIdDto $cartIdDto): CartId
    {
        return new CartId($cartIdDto->cartId);
    }
}
