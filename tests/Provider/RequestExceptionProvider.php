<?php

declare(strict_types=1);

namespace Challenge\Test\Provider;

final class RequestExceptionProvider
{
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
