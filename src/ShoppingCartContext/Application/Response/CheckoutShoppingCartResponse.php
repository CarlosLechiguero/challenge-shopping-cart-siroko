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
        parent::__construct();
    }

    public function getData(): array
    {
        return [
            "orderShoppingCart" => [
                "cartId" => $this->orderShoppingCart->cart->id->value,
                "products" => array_map( function($item) {
                    return [
                        "productId" => $item->productId->value,
                        "quantity" => $item->getQuantity()->getQuantity(),
                    ];
                },  $this->orderShoppingCart->cart->items()),
                "totalAmount" =>  $this->orderShoppingCart->amount->value . " €",
                "createdAt" => $this->orderShoppingCart->createdAt->format("Y-m-d H:i:s"),
            ]
        ];
    }
}
