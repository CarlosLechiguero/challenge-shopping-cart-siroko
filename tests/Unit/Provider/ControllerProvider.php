<?php

declare(strict_types=1);

namespace Challenge\Test\Provider;

use Challenge\ShoppingCartContext\Application\Response\CheckoutShoppingCartResponse;
use Challenge\ShoppingCartContext\Application\Response\DeleteItemShoppingCartResponse;
use Challenge\ShoppingCartContext\Application\Response\ListItemShoppingCartResponse;
use Challenge\ShoppingCartContext\Application\Response\UpdateItemShoppingCartResponse;
use Challenge\ShoppingCartContext\Domain\Entity\OrderShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\AmountValue;
use Challenge\ShoppingCartContext\Domain\ValueObject\OrderId;
use Symfony\Component\HttpFoundation\Request;
use Challenge\ShoppingCartContext\Domain\Entity\CartItem;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;
use Challenge\ShoppingCartContext\Application\Response\AddItemShoppingCartResponse;

final class ControllerProvider
{

    public static function cartResponse(): ShoppingCart
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
    private static function jsonRequest(array $data): Request
    {
        return Request::create(
            '',
            '',
            [],
            [],
            [],
            [],
            json_encode($data),
        );
    }
    public static function provideAddItemShoppingCartController(): array
    {
        return [
            [
                self::jsonRequest([
                    'cartId' => '11111111-1111-1111-1111-111111111111',
                    'productId' => '44444444-4444-4444-4444-444444444444',
                    'quantity' => 2
                ]),
                new AddItemShoppingCartResponse(self::cartResponse())
            ],
        ];
    }

    public static function provideCheckoutShoppingCartController(): array
    {
        return [
            [
                self::jsonRequest([
                    'cartId' => '11111111-1111-1111-1111-111111111111'
                ]),
                new CheckoutShoppingCartResponse(new OrderShoppingCart(
                    new OrderId('66666666-6666-6666-6666-666666666666'),
                    self::cartResponse(),
                    new AmountValue(30)
                ))
            ],
        ];
    }

    public static function provideDeleteItemShoppingCartController(): array
    {
        return [
            [
                self::jsonRequest([
                    'cartId' => '11111111-1111-1111-1111-111111111111',
                    'productId' => '44444444-4444-4444-4444-444444444444'
                ]),
                new DeleteItemShoppingCartResponse()
            ],
        ];
    }

    public static function provideListItemShoppingCartController(): array
    {
        $request = Request::create('');
        $request->attributes->set('cartId', '11111111-1111-1111-1111-111111111111');
        return [
            [
                $request,
                new ListItemShoppingCartResponse(self::cartResponse())
            ],
        ];
    }

    public static function provideUpdateItemShoppingCartController(): array
    {
        return [
            [
                self::jsonRequest([
                    'cartId' => '11111111-1111-1111-1111-111111111111',
                    'productId' => '44444444-4444-4444-4444-444444444444',
                    'quantity' => 2
                ]),
                new UpdateItemShoppingCartResponse(self::cartResponse())
            ],
        ];
    }
}
