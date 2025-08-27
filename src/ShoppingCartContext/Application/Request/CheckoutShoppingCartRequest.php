<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Request;

use Challenge\ShoppingCartContext\Domain\Entity\OrderShoppingCart;
use Challenge\ShoppingCartContext\Application\Exception\InvalidRequestException;
use Challenge\ShoppingCartContext\Application\Exception\InvalidCartRequestException;

final class CheckoutShoppingCartRequest
{
    public function __invoke(string $request): OrderShoppingCart
    {
        $request = json_decode($request, true);

        if (empty($request) || !is_array($request)) {
            throw new InvalidRequestException();
        }

        foreach (['cartId'] as $field) {
            if (empty($request[$field])) {
                throw InvalidCartRequestException::missingField($field);
            }
        }

        $orderShoppingCart = new OrderShoppingCart(

        );

        return $orderShoppingCart;
    }
}
