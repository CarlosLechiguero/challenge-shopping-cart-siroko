<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Request;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\RequestProvider;
use Challenge\ShoppingCartContext\Application\DTO\DeleteItemDto;
use Challenge\ShoppingCartContext\Application\Request\DeleteItemShoppingCartRequest;

final class DeleteItemShoppingCartRequestTest extends TestCase
{
    private readonly DeleteItemShoppingCartRequest $deleteItemShoppingCartRequest;

    protected function setUp(): void
    {
        $this->deleteItemShoppingCartRequest = new DeleteItemShoppingCartRequest();

        parent::setUp();
    }

    /**
     * @dataProvider provideDeleteItemRequest
     */
    public function testDeleteItemShoppingCartRequest(string $request, DeleteItemDto $deleteItemDto): void
    {
        $response = ($this->deleteItemShoppingCartRequest)($request);
        $this->assertEquals($deleteItemDto, $response);
        $this->assertInstanceOf(DeleteItemDto::class, $response);
    }

    public static function provideDeleteItemRequest(): array
    {
        return RequestProvider::provideDeleteItemRequest();
    }
}
