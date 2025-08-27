<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Request;

use Challenge\ShoppingCartContext\Domain\Entity\CartItem;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;
use Challenge\ShoppingCartContext\Application\Exception\InvalidRequestException;
use Challenge\ShoppingCartContext\Application\Exception\InvalidCartRequestException;

final class DeleteItemShoppingCartRequest
{
    public function __invoke(string $request): ShoppingCart
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

        $shoppingCart = new ShoppingCart(
            new CartId($request["cartId"]),
            [
                new CartItem(
                    new ProductId($request["productId"]),
                    new QuantityValue(0),
            )],
        );

        return $shoppingCart;
    }
}
