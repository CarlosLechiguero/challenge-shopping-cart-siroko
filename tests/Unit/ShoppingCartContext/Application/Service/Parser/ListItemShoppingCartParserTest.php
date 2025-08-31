<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Service\Parser;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\ParserProvider;
use Challenge\ShoppingCartContext\Application\DTO\CartIdDto;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Application\Service\Parser\ListItemShoppingCartParser;


final class ListItemShoppingCartParserTest extends TestCase
{
    private readonly ListItemShoppingCartParser $listItemShoppingCartParser;

    protected function setUp(): void
    {
        $this->listItemShoppingCartParser = new ListItemShoppingCartParser();
        parent::setUp();
    }

    /**
     * @dataProvider provideListItemsParser
     */
    public function testListItemShoppingCartParser(CartIdDto $cartIdDto, CartId $cartId): void
    {
        $response = ($this->listItemShoppingCartParser)($cartIdDto);
        $this->assertEquals($cartId, $response);
        $this->assertInstanceOf(CartId::class, $response);
    }

    public static function provideListItemsParser(): array
    {
        return ParserProvider::provideListItemsParser();
    }
}
