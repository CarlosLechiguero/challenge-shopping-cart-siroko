<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Service\Parser;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\ParserProvider;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Application\DTO\ShoppingCartDto;
use Challenge\ShoppingCartContext\Application\Service\Parser\AddItemShoppingCartParser;
use Challenge\ShoppingCartContext\Application\Service\Parser\UpdateItemShoppingCartParser;


final class UpdateItemShoppingCartParserTest extends TestCase
{
    private readonly UpdateItemShoppingCartParser $updateItemShoppingCartParser;

    protected function setUp(): void
    {
        $this->updateItemShoppingCartParser = new UpdateItemShoppingCartParser();
        parent::setUp();
    }

    /**
     * @dataProvider provideUpdateItemParser
     */
    public function testUpdateItemShoppingCartParser(ShoppingCartDto $shoppingCartDto, ShoppingCart $shoppingCart): void
    {
        $response = ($this->updateItemShoppingCartParser)($shoppingCartDto);
        $this->assertEquals($shoppingCart, $response);
        $this->assertInstanceOf(ShoppingCart::class, $response);
    }

    public static function provideUpdateItemParser(): array
    {
        return ParserProvider::provideUpdateItemParser();
    }
}
