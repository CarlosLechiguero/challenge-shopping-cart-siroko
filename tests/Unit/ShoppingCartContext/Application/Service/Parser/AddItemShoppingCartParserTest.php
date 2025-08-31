<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Service\Parser;

use Challenge\ShoppingCartContext\Application\DTO\ShoppingCartDto;
use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\ParserProvider;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Application\Service\Parser\AddItemShoppingCartParser;


final class AddItemShoppingCartParserTest extends TestCase
{
    private readonly AddItemShoppingCartParser $addProductToCartParser;

    protected function setUp(): void
    {
        $this->addProductToCartParser = new AddItemShoppingCartParser();
        parent::setUp();
    }

    /**
     * @dataProvider provideAddItemParser
     */
    public function testAddItemShoppingCartParser(ShoppingCartDto $shoppingCartDto, ShoppingCart $shoppingCart): void
    {
        $response = ($this->addProductToCartParser)($shoppingCartDto);
        $this->assertEquals($shoppingCart, $response);
        $this->assertInstanceOf(ShoppingCart::class, $response);
    }

    public static function provideAddItemParser(): array
    {
        return ParserProvider::provideAddItemParser();
    }
}
