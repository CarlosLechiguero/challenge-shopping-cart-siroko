<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Service\Parser;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\ParserProvider;
use Challenge\ShoppingCartContext\Application\DTO\DeleteItemDto;
use Challenge\ShoppingCartContext\Domain\ValueObject\DeleteProductValue;
use Challenge\ShoppingCartContext\Application\Service\Parser\DeleteItemShoppingCartParser;


final class DeleteItemShoppingCartParserTest extends TestCase
{
    private readonly DeleteItemShoppingCartParser $deleteItemShoppingCartParser;

    protected function setUp(): void
    {
        $this->deleteItemShoppingCartParser = new DeleteItemShoppingCartParser();
        parent::setUp();
    }

    /**
     * @dataProvider provideDeleteItemParser
     */
    public function testDeleteItemShoppingCartParser(DeleteItemDto $deleteItemDto, DeleteProductValue $deleteItem): void
    {
        $response = ($this->deleteItemShoppingCartParser)($deleteItemDto);
        $this->assertEquals($deleteItem, $response);
        $this->assertInstanceOf(DeleteProductValue::class, $response);
    }

    public static function provideDeleteItemParser(): array
    {
        return ParserProvider::provideDeleteItemParser();
    }
}
