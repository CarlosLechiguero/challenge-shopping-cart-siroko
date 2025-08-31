<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Mapper;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\MapperProvider;
use Challenge\ShoppingCartContext\Domain\Entity\OrderShoppingCart;
use Challenge\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Mapper\OrderShoppingCartMapper;
use Challenge\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Entity\OrderShoppingCartDoctrine;

final class OrderShoppingCartMapperTest extends TestCase
{
    private readonly OrderShoppingCartMapper $orderShoppingCartMapper;
    protected function setUp(): void
    {
        $this->orderShoppingCartMapper = new OrderShoppingCartMapper();
        parent::setUp();
    }

    /**
     * @dataProvider provideOrderShoppingCartMapper
     */
    public function testOrderShoppingCartMapper(OrderShoppingCart $orderShoppingCart, OrderShoppingCartDoctrine $orderDoctrine): void
    {
        $mapperDoctrine = $this->orderShoppingCartMapper::mapToDoctrine($orderShoppingCart);

        $this->assertInstanceOf(OrderShoppingCartDoctrine::class, $mapperDoctrine);
        $this->assertSame(MapperProvider::expectedCartArray($orderShoppingCart),$orderDoctrine->cart);
        $this->assertSame($orderShoppingCart->amount->value, $mapperDoctrine->amount);
        $this->assertEquals($orderShoppingCart->createdAt, $mapperDoctrine->createdAt);
    }

    public static function provideOrderShoppingCartMapper(): array
    {
        return MapperProvider::provideOrderShoppingCartMapper();
    }
}
