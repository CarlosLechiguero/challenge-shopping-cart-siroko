<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Infrastructure\Persistence\InMemory\Repository;

use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\Entity\CartItem;
use Challenge\ShoppingCartContext\Domain\Repository\ShoppingCartRepository;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;
use Symfony\Contracts\Cache\CacheInterface;

final class ShoppingCartCacheRepository implements ShoppingCartRepository
{
    public function __construct(
        private readonly CacheInterface $cache,
        ) {
        }

    public function save(ShoppingCart $cart, bool $persist = false): void
    {
        $key = 'cart_' . $cart->id->value();

        $this->cache->delete($key);
        $this->cache->get($key, fn() => $this->serializeCart($cart));
    }

    public function find(CartId $cartId): ?ShoppingCart
    {
        $key = 'cart_' . $cartId->value();
        $inCacheShoppingCart = $this->cache->get($key, fn() => null);

        if (null === $inCacheShoppingCart) {
            return null;
        }

        return $this->unserializeCart($inCacheShoppingCart);
    }

    public function deleteCartItem(ShoppingCart $cart): void
    {
        $key = 'cart_' . $cart->id->value();
        $inCacheShoppingCart = $this->cache->get($key, fn() => null);

        $existingCart = $this->unserializeCart($inCacheShoppingCart);
        $targetItem = $cart->firstItem();

        $existingCart->removeItemEntity($targetItem);
        $this->cache->delete($key);
        $this->cache->get($key, fn() => $this->serializeCart($existingCart));
    }

    private function serializeCart(ShoppingCart $cart): array
    {
        return [
            'id' => $cart->id->value(),
            'items' => array_map(fn(CartItem $item) => [
                'productId' => $item->productId->value(),
                'quantity' => $item->getQuantity()->getQuantity()
            ], $cart->items())
        ];
    }

    private function unserializeCart(array $data): ShoppingCart
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
