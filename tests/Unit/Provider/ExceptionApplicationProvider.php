<?php

declare(strict_types=1);

namespace Challenge\Test\Provider;

use Challenge\ShoppingCartContext\Domain\Entity\CartItem;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;
use Challenge\ShoppingCartContext\Domain\ValueObject\DeleteProductValue;
use Challenge\ShoppingCartContext\Application\Query\CheckoutShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Query\ListItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Query\DeleteItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Query\UpdateItemShoppingCartQuery;

final class ExceptionApplicationProvider
{
    public static function provideCheckoutCartShoppingNotFoundException(): array
    {
        return [
            [
                new CheckoutShoppingCartQuery(
                    new CartId('11111111-1111-1111-1111-111111111111')
                ),
                'Shopping Cart not found'
            ]
        ];
    }

    public static function provideDeleteCartShoppingNotFoundException(): array
    {
        return [
            [
                new DeleteItemShoppingCartQuery(
                    new DeleteProductValue(
                        new CartId('11111111-1111-1111-1111-111111111111'), 
                        new ProductId('44444444-4444-4444-4444-444444444444')
                    )
                ),
                'Shopping Cart not found'
            ]
        ];
    }

    public static function provideListCartShoppingNotFoundException(): array
    {
        return [
            [
                new ListItemShoppingCartQuery(
                    new CartId('11111111-1111-1111-1111-111111111111')
                ),
                'Shopping Cart not found'
            ]
        ];
    }

    public static function provideUpdateCartShoppingNotFoundException(): array
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
                'Shopping Cart not found'
            ]
        ];
    }
    
    
    public static function provideAddItemRequestInvalidRequestException(): array
    {
        return [
            [
                '',
                'Invalid request'
            ],
            [
                '{}',
                'Invalid request'
            ],
            [
                '}',
                'Invalid request'
            ],
            [
                '{
                    "cartId": "3fa85f64-5717-4562-b3fc-2c963f66afa6"
                    "productId": "6fa85f64-5717-4562-b3fc-2c963f66afb3"
                    "quantity": 2
                }',
                'Invalid request'
            ]
        ];
    }

    public static function provideAddItemRequestInvalidCartRequestException(): array
    {
        return [
            [
                '{
                    "cartId": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
                    "productId": "6fa85f64-5717-4562-b3fc-2c963f66afb3"
                }',
                'The field quantity is required.'
            ],
            [
                '{
                    "cartId": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
                    "quantity": 2
                }',
                'The field productId is required.'
            ],
            [
                '{
                    "productId": "6fa85f64-5717-4562-b3fc-2c963f66afb3",
                    "quantity": 2
                }',
                'The field cartId is required.'
            ],
        ];
    }

}
