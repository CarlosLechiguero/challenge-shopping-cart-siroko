<?php

declare(strict_types=1);

namespace Challenge\Test\Provider;

use Challenge\ShoppingCartContext\Domain\Entity\CartItem;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;


final class ExceptionDomainProvider
{
    public static function provideInvalidAmountException(): array
    {
        return [
            [
                -20.0
            ],
        ];
    }

    public static function provideInvalidIdException(): array
    {
        return [
            [
                "asd",
            ],
            [
                ""
            ],
            [
                "11111111-1111-1111-1111-11111111111"
            ],
                        [
                "1111111-1111-1111-1111-111111111111"
            ],
        ];
    }
    public static function provideInvalidQuantityException(): array
    {
        return [
            [
                -3
            ],
            [
                0
            ],
        ];
    }
    public static function provideProductNotFoundExceptionUpdateService(): array
    {
        return [
            [
                new ShoppingCart(
                    new CartId('11111111-1111-1111-1111-111111111111'),
                    [
                        new CartItem(
                            new ProductId('44444444-4444-4444-4444-444444444444'),
                            new QuantityValue(2)
                        )
                    ]
                ),
                new ProductId('33333333-3333-3333-3333-333333333333'),
                new QuantityValue(2)
            ],
        ];
    }
    public static function provideProductNotFoundExceptionRemoveService(): array
    {
        return [
            [
                new ShoppingCart(
                    new CartId('11111111-1111-1111-1111-111111111111'),
                    [
                        new CartItem(
                            new ProductId('44444444-4444-4444-4444-444444444444'),
                            new QuantityValue(2)
                        )
                    ]
                ),
                new ProductId('33333333-3333-3333-3333-333333333333'),
            ],
        ];
    }
}