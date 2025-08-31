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
use Challenge\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Entity\OrderShoppingCartDoctrine;
use DateTimeImmutable;

final class MapperProvider
{
    public static function expectedCartArray(OrderShoppingCart $order): array
    {
        return [
            'id' => $order->cart->id->value,
            'items' => array_map(
                fn(CartItem $item) => [
                    'product_id' => $item->productId->value,
                    'quantity'   => $item->getQuantity()->getQuantity(),
                ],
                $order->cart->items()
            ),
        ];
    }

    public static function provideOrderShoppingCartMapper(): array
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
                ),
                new OrderShoppingCartDoctrine(
                    '33333333-3333-3333-3333-333333333333',
                    [
                            'id' => '11111111-1111-1111-1111-111111111111',
                            'items' => [
                                0 => [
                                    'product_id' => '44444444-4444-4444-4444-444444444444',
                                    'quantity' => 2,
                                ]
                            ],
                        ],
                    30,
                    new DateTimeImmutable(),
                )
            ],
        ];
    }

    public static function provideShoppingCartMapper(): array
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
                [
                    'id' => '11111111-1111-1111-1111-111111111111',
                    'items' => [
                        [
                        'productId' => '44444444-4444-4444-4444-444444444444',
                        'quantity' => 2
                        ],
                    ]
                ]
            ],
        ];
    }

    public static function provideShoppingCartMapperFind(): array
    {
        return [[]];
    }

    public static function provideShoppingCartMapperRemoveItem(): array
    {
        return [[]];
    }

    public static function provideShoppingCartMapperSave(): array
    {
        return [[]];
    }

    public static function provideShoppingCartMapperDeleteCart(): array
    {
        return [[]];
    }
}
