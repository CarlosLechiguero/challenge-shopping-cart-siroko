<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Response;

use Challenge\SharedContext\Application\Response\AbstractResponse;
use Challenge\ShoppingCartContext\Domain\Entity\OrderShoppingCart;

final class CheckoutShoppingCartResponse extends AbstractResponse
{
    public function __construct(
        public readonly OrderShoppingCart $orderShoppingCart,
    ) {

    }

    public function getResponse(): array
    {
        return [
            "orderShoppingCart" => [
                "cartId" => $this->orderShoppingCart->cart->id->value,
                "products" => array_map( function($item) {
                    return [
                        "productId" => $item->productId->value(),
                        "quantity" => $item->getQuantity()->getQuantity(),
                    ];
                },  $this->orderShoppingCart->cart->items()),
                "totalAmount" =>  $this->orderShoppingCart->amount->value . " €",
                "createdAt" => $this->orderShoppingCart->createdAt->format("yyyy-mm-dd H:i:s"),
            ]
        ];
    }
}
