<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Infrastructure\Persistence\InMemory\Mapper;

use Challenge\ShoppingCartContext\Domain\Entity\CartItem;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;

class ShoppingCartMapper
{
    public static function serializeCart(ShoppingCart $cart): array
    {
        return [
            'id' => $cart->id->value,
            'items' => array_map(fn(CartItem $item) => [
                'productId' => $item->productId->value(),
                'quantity' => $item->getQuantity()->getQuantity()
            ], $cart->items())
        ];
    }

    public static function unserializeCart(array $data): ShoppingCart
    {
        $cart = new ShoppingCart(new CartId($data['id']));
        foreach ($data['items'] as $item) {
            $cart->addItemEntity(
                new CartItem(
                    new ProductId($item['productId']),
                    new QuantityValue($item['quantity'])
                )
            );
        }
        return $cart;
    }
}
