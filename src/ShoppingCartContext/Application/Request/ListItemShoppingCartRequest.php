<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Request;

use Challenge\ShoppingCartContext\Application\DTO\CartIdDto;
use Challenge\ShoppingCartContext\Application\Exception\InvalidRequestException;

final class ListItemShoppingCartRequest
{
    public function __invoke(string $request): CartIdDto
    {
        if (empty($request)) {
            throw new InvalidRequestException();
        }

        return new CartIdDto($request);
    }
}
