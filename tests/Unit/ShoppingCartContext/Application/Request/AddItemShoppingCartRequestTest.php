<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Request;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\RequestProvider;
use Challenge\ShoppingCartContext\Application\DTO\ShoppingCartDto;
use Challenge\ShoppingCartContext\Application\Request\AddItemShoppingCartRequest;

final class AddItemShoppingCartRequestTest extends TestCase
{
    private readonly AddItemShoppingCartRequest $addProductToCartRequest;

    protected function setUp(): void
    {
        $this->addProductToCartRequest = new AddItemShoppingCartRequest();

        parent::setUp();
    }

    /**
     * @dataProvider provideAddItemRequest
     */
    public function testAddItemShoppingCartRequest(string $request, ShoppingCartDto $shoppingCartDto): void
    {
        $response = ($this->addProductToCartRequest)($request);
        $this->assertEquals($shoppingCartDto, $response);
        $this->assertInstanceOf(ShoppingCartDto::class, $response);
    }

    public static function provideAddItemRequest(): array
    {
        return RequestProvider::provideAddItemRequest();
    }
}
