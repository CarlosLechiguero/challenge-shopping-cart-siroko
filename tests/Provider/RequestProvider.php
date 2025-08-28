<?php

declare(strict_types=1);

namespace Challenge\Test\Provider;

use Challenge\ShoppingCartContext\Application\DTO\CartIdDto;
use Challenge\ShoppingCartContext\Application\DTO\DeleteItemDto;
use Challenge\ShoppingCartContext\Application\DTO\ShoppingCartDto;

final class RequestProvider
{
    public static function provideAddItemRequest(): array
    {
        return [
            [
                '{
                    "cartId": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
                    "productId": "6fa85f64-5717-4562-b3fc-2c963f66afb3",
                    "quantity": 2
                }',
                new ShoppingCartDto(
                    "3fa85f64-5717-4562-b3fc-2c963f66afa6",
                    "6fa85f64-5717-4562-b3fc-2c963f66afb3",
                    2
                )
            ],
        ];
    }

    public static function provideCheckoutRequest(): array
    {
        return [
            [
                '{
                    "cartId": "3fa85f64-5717-4562-b3fc-2c963f66afa6"
                }',
                new CartIdDto(
                    "3fa85f64-5717-4562-b3fc-2c963f66afa6",
                )
            ],
        ];
    }

    public static function provideDeleteItemRequest(): array
    {
        return [
            [
                '{
                    "cartId": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
                    "productId": "6fa85f64-5717-4562-b3fc-2c963f66afb6"
                }',
                new DeleteItemDto(
                    "3fa85f64-5717-4562-b3fc-2c963f66afa6",
                    "6fa85f64-5717-4562-b3fc-2c963f66afb6"
                )
            ],
        ];
    }

    public static function provideListItemsRequest(): array
    {
        return [
            [
                "3fa85f64-5717-4562-b3fc-2c963f66afa6"
                ,
                new CartIdDto(
                    "3fa85f64-5717-4562-b3fc-2c963f66afa6",
                )
            ],
        ];
    }

    public static function provideUpdateItemRequest(): array
    {
        return [
            [
                '{
                    "cartId": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
                    "productId": "6fa85f64-5717-4562-b3fc-2c963f66afb3",
                    "quantity": 2
                }',
                new ShoppingCartDto(
                    "3fa85f64-5717-4562-b3fc-2c963f66afa6",
                    "6fa85f64-5717-4562-b3fc-2c963f66afb3",
                    2
                )
            ],
        ];
    }  
}
