<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Infrastructure\Persistence\InMemory\Mapper;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\MapperProvider;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Infrastructure\Persistence\InMemory\Mapper\ShoppingCartMapper;

final class ShoppingCartMapperTest extends TestCase
{
    private readonly ShoppingCartMapper $shoppingCartMapper;
    protected function setUp(): void
    {
        $this->shoppingCartMapper = new ShoppingCartMapper();
        parent::setUp();
    }

    /**
     * @dataProvider provideShoppingCartMapper
     */
    public function testShoppingCartMapper(ShoppingCart $cart, array $expectedArray): void
    {
        $cartSerialized = $this->shoppingCartMapper::serializeCart($cart);
        $this->assertSame($expectedArray, $cartSerialized);

        $cartUnserialized = $this->shoppingCartMapper::unserializeCart($cartSerialized);

        $this->assertSame($cart->id->value, $cartUnserialized->id->value);
        $this->assertCount(count($cart->items()), $cartUnserialized->items());

        foreach ($cart->items() as $index => $item) {
            $unItem = $cartUnserialized->items()[$index];
            $this->assertSame($item->productId->value, $unItem->productId->value);
            $this->assertSame($item->getQuantity()->getQuantity(), $unItem->getQuantity()->getQuantity());
        }
    }

    public static function provideShoppingCartMapper(): array
    {
        return MapperProvider::provideShoppingCartMapper();
    }
}
