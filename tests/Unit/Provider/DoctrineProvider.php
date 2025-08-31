<?php

declare(strict_types=1);

namespace Challenge\Test\Provider;

use Challenge\ShoppingCartContext\Domain\Entity\CartItem;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\OrderId;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\AmountValue;
use Challenge\ShoppingCartContext\Domain\Entity\OrderShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;


final class DoctrineProvider
{
    public static function provideOrderShoppingCartDoctrineRepository(): array
    {
        return [
            [
                new OrderShoppingCart(
                    new OrderId('33333333-3333-3333-3333-333333333333'),
                    new ShoppingCart(
                        new CartId('11111111-1111-1111-1111-111111111111'),
                        [
                            new CartItem(
                            new ProductId('44444444-4444-4444-4444-444444444444'),
                            new QuantityValue(2)
                            )
                        ]
                    ),
                    new AmountValue(30)
                )
            ]
        ];
    }
}
