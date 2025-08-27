<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\Service;

use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;
use Challenge\ShoppingCartContext\Domain\Exception\ProductNotFoundException;

final class UpdateProductToCartService
{
    public function __invoke(ShoppingCart $cart, ProductId $productId, QuantityValue $quantity): void
    {
        foreach ($cart->items() as $item) {
            if ($item->productId->equals($productId)) {
                $item->setQuantity($quantity);
                return;
            }
        }

        throw new ProductNotFoundException("Product not found.");
    }
}
