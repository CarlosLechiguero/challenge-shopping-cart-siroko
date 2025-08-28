<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Infrastructure\Persistence\InMemory\Repository;

use Symfony\Contracts\Cache\CacheInterface;
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
        private readonly CacheInterface $cache,
    ) {
    }

    public function save(ShoppingCart $cart, bool $persist = false): void
    {
        $key = 'cart_' . $cart->id->value;

        $this->cache->delete($key);
        $this->cache->get($key, fn() => ShoppingCartMapper::serializeCart($cart));
    }

    public function find(CartId $cartId): ?ShoppingCart
    {
        $key = 'cart_' . $cartId->value;
        $inCacheShoppingCart = $this->cache->get($key, fn() => null);

        if (null === $inCacheShoppingCart) {
            return null;
        }

        return ShoppingCartMapper::unserializeCart($inCacheShoppingCart);
    }

    public function deleteCartItem(CartId $cartId, ProductId $productId): void
    {
        $key = 'cart_' . $cartId->value;
        $inCacheShoppingCart = $this->cache->get($key, fn() => null);

        $existingCart = ShoppingCartMapper::unserializeCart($inCacheShoppingCart);
        $targetItem = new CartItem(
            $productId, 
            new QuantityValue(0)
        );

        $existingCart->removeItemEntity(item: $targetItem);
        $this->cache->delete($key);
        $this->cache->get($key, fn() => ShoppingCartMapper::serializeCart($existingCart));
    }
}
