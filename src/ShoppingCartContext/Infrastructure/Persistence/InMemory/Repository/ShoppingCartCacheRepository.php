<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Infrastructure\Persistence\InMemory\Repository;

use Challenge\ShoppingCartContext\Domain\Entity\CartItem;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;
use Challenge\ShoppingCartContext\Domain\Repository\ShoppingCartRepository;
use Challenge\ShoppingCartContext\Infrastructure\Persistence\InMemory\Mapper\ShoppingCartMapper;

final class ShoppingCartCacheRepository implements ShoppingCartRepository
{

    public function __construct(
        private \Memcached $memcached
    ) {

    }

    public function save(ShoppingCart $cart, bool $persist = false): void
    {
        $this->memcached->set('cart_' . $cart->id->value, ShoppingCartMapper::serializeCart($cart));
    }

    public function find(CartId $cartId): ?ShoppingCart
    {
        $data = $this->memcached->get('cart_' . $cartId->value);
        return $data ? ShoppingCartMapper::unserializeCart($data) : null;
    }

    public function deleteCartItem(CartId $cartId, ProductId $productId): void
    {
        $cart = $this->find($cartId);

        $targetItem = new CartItem($productId, new QuantityValue(1));
        $cart->removeItemEntity( $targetItem);

        $this->save($cart);
    }

    public function deleteCart(ShoppingCart $cart): void
    {
        $this->memcached->delete('cart_' . $cart->id->value);
    }
}
