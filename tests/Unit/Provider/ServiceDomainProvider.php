<?php

declare(strict_types=1);

namespace Challenge\Test\Provider;

use Challenge\ShoppingCartContext\Domain\Entity\CartItem;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;

final class ServiceDomainProvider
{
    public static function getShoppingCart(): ShoppingCart
    {
        return new ShoppingCart(
            new CartId('11111111-1111-1111-1111-111111111111'),
            [
                new CartItem(
                    new ProductId('44444444-4444-4444-4444-444444444444'),
                    new QuantityValue(2)
                )
            ]
        );
    }
    public static function provideAddProductToCartService(): array
    {

        return [
            [
                self::getShoppingCart(),
                new ProductId('44444444-4444-4444-4444-444444444444'),
                new QuantityValue(2)
            ],
        ];
    }

    public static function provideCalculateShoppingCartAmountService(): array
    {

        return [
            [
                self::getShoppingCart(),
            ],
        ];
    }

    public static function provideRemoveProductFromCartService(): array
    {

        return [
            [
                self::getShoppingCart(),
                new ProductId('44444444-4444-4444-4444-444444444444'),
            ],
        ];
    }

    public static function provideUpdateProductToCartService(): array
    {

        return [
            [
                self::getShoppingCart(),
                new ProductId('44444444-4444-4444-4444-444444444444'),
                new QuantityValue(2)
            ],
        ];
    }
}
