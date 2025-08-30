<?php

declare(strict_types=1);

namespace Challenge\Test\Provider;

use Challenge\ShoppingCartContext\Domain\Entity\CartItem;
use Challenge\ShoppingCartContext\Application\DTO\CartIdDto;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Application\DTO\DeleteItemDto;
use Challenge\ShoppingCartContext\Application\DTO\ShoppingCartDto;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;
use Challenge\ShoppingCartContext\Domain\ValueObject\DeleteProductValue;

final class ParserProvider
{
    public static function provideAddItemParser(): array
    {
        return [
            [
                new ShoppingCartDto(
                    "3fa85f64-5717-4562-b3fc-2c963f66afa6",
                    "6fa85f64-5717-4562-b3fc-2c963f66afb3",
                    2
                ),
                new ShoppingCart(
                    new CartId("3fa85f64-5717-4562-b3fc-2c963f66afa6"),
                    [
                        new CartItem(
                            new ProductId("6fa85f64-5717-4562-b3fc-2c963f66afb3"),
                            new QuantityValue(2),
                    )],
                )

            ],
        ];
    }

    public static function provideCheckoutParser(): array
    {
        return [
            [
                new CartIdDto(
                    "3fa85f64-5717-4562-b3fc-2c963f66afa6",
                ),
                new CartId("3fa85f64-5717-4562-b3fc-2c963f66afa6"),
            ],
        ];
    }

    public static function provideDeleteItemParser(): array
    {
        return [
            [
                new DeleteItemDto(
                    "3fa85f64-5717-4562-b3fc-2c963f66afa6",
                    "6fa85f64-5717-4562-b3fc-2c963f66afb6"
                ),
                new DeleteProductValue(
                    new CartId("3fa85f64-5717-4562-b3fc-2c963f66afa6"),
                    new ProductId("6fa85f64-5717-4562-b3fc-2c963f66afb6")
                ),
            ],
        ];
    }

    public static function provideListItemsParser(): array
    {
        return [
            [
                new CartIdDto(
                    "3fa85f64-5717-4562-b3fc-2c963f66afa6",
                ),
                new CartId("3fa85f64-5717-4562-b3fc-2c963f66afa6"),
            ],
        ];
    }

    public static function provideUpdateItemParser(): array
    {
        return [
            [
                new ShoppingCartDto(
                    "3fa85f64-5717-4562-b3fc-2c963f66afa6",
                    "6fa85f64-5717-4562-b3fc-2c963f66afb3",
                    2
                ),
                new ShoppingCart(
                    new CartId("3fa85f64-5717-4562-b3fc-2c963f66afa6"),
                    [
                        new CartItem(
                            new ProductId("6fa85f64-5717-4562-b3fc-2c963f66afb3"),
                            new QuantityValue(2),
                    )],
                )

            ],
        ];
    }
}
