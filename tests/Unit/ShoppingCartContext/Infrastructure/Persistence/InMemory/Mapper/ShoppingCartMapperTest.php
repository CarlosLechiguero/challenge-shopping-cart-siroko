<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Infrastructure\Persistence\InMemory\Mapper;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\MapperProvider;
use Challenge\Test\Provider\ControllerProvider;

final class ShoppingCartMapperTest extends TestCase
{
    protected function setUp(): void
    {

        parent::setUp();
    }

    /**
     * @dataProvider provideShoppingCartMapper
     */
    public function testShoppingCartMapper(): void
    {

    }

    public static function provideShoppingCartMapper(): array
    {
        return MapperProvider::provideShoppingCartMapper();
    }
}
