<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Response;

use Challenge\SharedContext\Application\Response\AbstractResponse;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;

final class AddItemShoppingCartResponse extends AbstractResponse
{
    public function __construct(
        public readonly ShoppingCart $shoppingCart,
    ) {

    }

    public function getResponse(): array
    {
        return [
            "shoppingCart" => [
                "cartId" => $this->shoppingCart->id->value,
                "products" => array_map( function($item) {
                    return [
                        "productId" => $item->productId->value(),
                        "quantity" => $item->getQuantity()->getQuantity(),
                    ];
                }, $this->shoppingCart->items()),
            ]
        ];
    }
}
