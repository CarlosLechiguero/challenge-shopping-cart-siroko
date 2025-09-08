<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Service\Parser;

use Challenge\ShoppingCartContext\Domain\Entity\CartItem;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Application\DTO\ShoppingCartDto;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;

class UpdateItemShoppingCartParser
{
    public function __invoke(ShoppingCartDto $shoppingCartDto): ShoppingCart
    {
        $shoppingCart = new ShoppingCart(
            new CartId($shoppingCartDto->cartId),
            [
                new CartItem(
                    new ProductId($shoppingCartDto->productId),
                    new QuantityValue($shoppingCartDto->quantity),
            )],
        );

        return $shoppingCart;
    }
}
