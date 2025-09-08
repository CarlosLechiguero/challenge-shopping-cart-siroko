<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Mapper;

use Challenge\ShoppingCartContext\Domain\Entity\CartItem;
use Challenge\ShoppingCartContext\Domain\Entity\OrderShoppingCart;
use Challenge\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Entity\OrderShoppingCartDoctrine;

final class OrderShoppingCartMapper
{
    public static function mapToDoctrine(OrderShoppingCart $order): OrderShoppingCartDoctrine
    {
        $shoppingCart = [
            'id' => $order->cart->id->value,
            'items' => array_map(
                fn(CartItem $item) => [
                    'product_id' => $item->productId->value,
                    'quantity'   => $item->getQuantity()->getQuantity(),
                ],
                $order->cart->items()
            ),
        ];
         
        return new OrderShoppingCartDoctrine(
            $order->id->value,
            $shoppingCart,            
            $order->amount->value,
            $order->createdAt,
        );
    }
}
