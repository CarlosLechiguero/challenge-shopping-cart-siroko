<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\Service;

use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\Exception\ProductNotFoundException;

final class RemoveProductFromCartService
{
    public function __invoke(ShoppingCart $cart, ProductId $productId): void
    {
        foreach ($cart->items() as $item) {
            if ($item->productId->equals($productId)) {
                $cart->removeItemEntity($item);
                return;
            }
        }

        throw new ProductNotFoundException("Product not found.");
    }
}
