<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Request;

use Challenge\ShoppingCartContext\Application\DTO\DeleteItemDto;
use Challenge\ShoppingCartContext\Application\Exception\InvalidRequestException;
use Challenge\ShoppingCartContext\Application\Exception\InvalidCartRequestException;

final class DeleteItemShoppingCartRequest
{
    public function __invoke(string $request): DeleteItemDto
    {

        $request = json_decode($request, true);

        if (empty($request) || !is_array($request)) {
            throw new InvalidRequestException();
        }

        foreach (['cartId', 'productId'] as $field) {
            if (empty($request[$field])) {
                throw InvalidCartRequestException::missingField($field);
            }
        }

        return new DeleteItemDto($request["cartId"], $request["productId"]);
    }
}
