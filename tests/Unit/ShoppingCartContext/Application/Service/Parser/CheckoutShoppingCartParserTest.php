<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Service\Parser;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\ParserProvider;
use Challenge\ShoppingCartContext\Application\DTO\CartIdDto;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Application\Service\Parser\CheckoutShoppingCartParser;


final class CheckoutShoppingCartParserTest extends TestCase
{
    private readonly CheckoutShoppingCartParser $checkoutShoppingCartParser;

    protected function setUp(): void
    {
        $this->checkoutShoppingCartParser = new CheckoutShoppingCartParser();
        parent::setUp();
    }

    /**
     * @dataProvider provideCheckoutParser
     */
    public function testCheckoutShoppingCartParser(CartIdDto $cartIdDto, CartId $cartId): void
    {
        $response = ($this->checkoutShoppingCartParser)($cartIdDto);
        $this->assertEquals($cartId, $response);
        $this->assertInstanceOf(CartId::class, $response);
    }

    public static function provideCheckoutParser(): array
    {
        return ParserProvider::provideCheckoutParser();
    }
}
