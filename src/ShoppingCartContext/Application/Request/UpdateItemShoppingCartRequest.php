<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Request;

use Challenge\ShoppingCartContext\Application\DTO\ShoppingCartDto;
use Challenge\ShoppingCartContext\Application\Exception\InvalidRequestException;
use Challenge\ShoppingCartContext\Application\Exception\InvalidCartRequestException;

final class UpdateItemShoppingCartRequest
{
    public function __invoke(string $request): ShoppingCartDto
    {

        $request = json_decode($request, true);

        if (empty($request) || !is_array($request)) {
            throw new InvalidRequestException();
        }

        foreach (['cartId', 'productId', 'quantity'] as $field) {
            if (empty($request[$field])) {
                throw InvalidCartRequestException::missingField($field);
            }
        }

        $addItemDto = new ShoppingCartDto(
            $request["cartId"],
            $request["productId"],
            $request["quantity"],
        );

        return $addItemDto;
    }
}
