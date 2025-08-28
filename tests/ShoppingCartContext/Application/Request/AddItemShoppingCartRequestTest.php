<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Request;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\RequestProvider;
use Challenge\Test\Provider\RequestExceptionProvider;
use Challenge\ShoppingCartContext\Application\DTO\ShoppingCartDto;
use Challenge\ShoppingCartContext\Application\Exception\InvalidRequestException;
use Challenge\ShoppingCartContext\Application\Request\AddItemShoppingCartRequest;
use Challenge\ShoppingCartContext\Application\Exception\InvalidCartRequestException;

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

    /**
     * @dataProvider provideAddItemRequestInvalidRequestException
     */
    public function testInvalidRequestException(string $request, string $responseApi): void
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage($responseApi);

        ($this->addProductToCartRequest)($request);
    }

    /**
     * @dataProvider provideAddItemRequestInvalidCartRequestException
     */
    public function testInvalidCartRequestException(string $request, string $responseApi): void
    {
        $this->expectException(InvalidCartRequestException::class);
        $this->expectExceptionMessage($responseApi);

        ($this->addProductToCartRequest)($request);
    }

    public static function provideAddItemRequest(): array
    {
        return RequestProvider::provideAddItemRequest();
    }

    public static function provideAddItemRequestInvalidRequestException(): array
    {
        return RequestExceptionProvider::provideAddItemRequestInvalidRequestException();
    }

    public static function provideAddItemRequestInvalidCartRequestException(): array
    {
        return RequestExceptionProvider::provideAddItemRequestInvalidCartRequestException();
    }
}
