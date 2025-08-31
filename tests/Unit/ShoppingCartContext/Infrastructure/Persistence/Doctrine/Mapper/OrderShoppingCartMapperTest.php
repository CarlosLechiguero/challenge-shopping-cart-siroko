<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Mapper;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\MapperProvider;
use Challenge\Test\Provider\ControllerProvider;

final class OrderShoppingCartMapperTest extends TestCase
{
    protected function setUp(): void
    {

        parent::setUp();
    }

    /**
     * @dataProvider provideOrderShoppingCartMapper
     */
    public function testOrderShoppingCartMapper(): void
    {

    }

    public static function provideOrderShoppingCartMapper(): array
    {
        return MapperProvider::provideOrderShoppingCartMapper();
    }
}
