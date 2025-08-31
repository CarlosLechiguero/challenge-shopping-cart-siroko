<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\Service;

use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\Entity\CartItem;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;

final class AddProductToCartService
{
    public function __invoke(ShoppingCart $cart, ProductId $productId, QuantityValue $quantity): void
    {
        foreach ($cart->items() as $item) {
            if ($item->productId->equals($productId)) {
                $item->increaseQuantity($quantity);
                return;
            }
        }

        $cart->addItemEntity(new CartItem($productId, $quantity));
    }
}
