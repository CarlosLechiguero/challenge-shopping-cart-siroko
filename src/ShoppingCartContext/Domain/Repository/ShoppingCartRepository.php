<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\Repository;

use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;

interface ShoppingCartRepository
{
    public function save(ShoppingCart $cart, bool $persist = false): void;

    public function find(CartId $cartId): ?ShoppingCart;

    public function deleteCartItem(CartId $cartId, ProductId $productId): void;
    
    public function deleteCart(ShoppingCart $cart): void;
    

}
