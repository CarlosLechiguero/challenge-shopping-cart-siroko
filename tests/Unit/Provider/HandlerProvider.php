<?php

declare(strict_types=1);

namespace Challenge\Test\Provider;

use DateTimeImmutable;
use Challenge\ShoppingCartContext\Domain\Entity\CartItem;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;
use Challenge\ShoppingCartContext\Domain\ValueObject\DeleteProductValue;
use Challenge\ShoppingCartContext\Application\Query\AddItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Query\CheckoutShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Query\ListItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Query\DeleteItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Query\UpdateItemShoppingCartQuery;

final class HandlerProvider
{

    public static function initCart(): ShoppingCart
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

    public static function provideCheckoutOrder(): array
    {

        return [
            [
                new CheckoutShoppingCartQuery(
                    new CartId('11111111-1111-1111-1111-111111111111')
                ),
                self::initCart()
            ],
        ];
    }

    public static function provideAddCartItem(): array
    {
        $productId1 = new ProductId('22222222-2222-2222-2222-222222222222');
        $productId2 = new ProductId('44444444-4444-4444-4444-444444444444');

        $newCart = new ShoppingCart(
            new CartId('11111111-1111-1111-1111-111111111111'),
            [new CartItem($productId1, new QuantityValue(2))]
        );

        $expectedNewCart = $newCart;
        $existingCart = new ShoppingCart(
            new CartId('33333333-3333-3333-3333-333333333333'),
            [new CartItem($productId2, new QuantityValue(1))]
        );

        $queryExisting = new AddItemShoppingCartQuery(
            new ShoppingCart(
                $existingCart->id,
                [new CartItem($productId2, new QuantityValue(2))]
            )
        );

        $expectedExistingCart = new ShoppingCart(
            $existingCart->id,
            [new CartItem($productId2, new QuantityValue(3))]
        );

        return [
            [new AddItemShoppingCartQuery($newCart), null, $expectedNewCart],
            [$queryExisting, $existingCart, $expectedExistingCart],
        ];
    }

    public static function provideUpdateCartitem(): array
    {
        return [
            [
                new UpdateItemShoppingCartQuery( new ShoppingCart(
                    new CartId('11111111-1111-1111-1111-111111111111'), 
                    [
                            new CartItem(
                                new ProductId('44444444-4444-4444-4444-444444444444'),
                                new QuantityValue(4)
                            )
                           
                    ], 
                    )
                ),
                self::initCart()
            ]
        ];
    }

    public static function provideDeleteCartItem(): array
    {
        return [
            [
                new DeleteItemShoppingCartQuery(
                    new DeleteProductValue(
                        new CartId('11111111-1111-1111-1111-111111111111'), 
                        new ProductId('44444444-4444-4444-4444-444444444444')
                    )
                ),
                self::initCart()
            ]
        ];
    }

    public static function provideListItems(): array
    {
        return [
            [
                new ListItemShoppingCartQuery(
                    new CartId('11111111-1111-1111-1111-111111111111')
                ),
                self::initCart()
            ]
        ];
    }
}
