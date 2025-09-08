<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\Service;

use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\AmountValue;

final class CalculateShoppingCartAmountService
{
    public function __invoke(ShoppingCart $cart): AmountValue
    {
        $total = 0.0;

        foreach ($cart->items() as $item) {
            $quantity = $item->getQuantity()->getQuantity();
            $price = random_int(1, 20);
            $total += $quantity * $price;
        }

        return new AmountValue($total);
    }
}
