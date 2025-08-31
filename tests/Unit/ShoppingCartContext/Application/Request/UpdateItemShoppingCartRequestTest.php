<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Request;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\RequestProvider;
use Challenge\ShoppingCartContext\Application\DTO\ShoppingCartDto;
use Challenge\ShoppingCartContext\Application\Request\UpdateItemShoppingCartRequest;

final class UpdateItemShoppingCartRequestTest extends TestCase
{
    private readonly UpdateItemShoppingCartRequest $updateItemShoppingCartRequest;

    protected function setUp(): void
    {
        $this->updateItemShoppingCartRequest = new UpdateItemShoppingCartRequest();

        parent::setUp();
    }

    /**
     * @dataProvider provideUpdateItemRequest
     */
    public function testUpdateItemShoppingCartRequest(string $request, ShoppingCartDto $shoppingCartDto): void
    {
        $response = ($this->updateItemShoppingCartRequest)($request);
        $this->assertEquals($shoppingCartDto, $response);
        $this->assertInstanceOf(ShoppingCartDto::class, $response);
    }

    public static function provideUpdateItemRequest(): array
    {
        return RequestProvider::provideUpdateItemRequest();
    }
    
}
