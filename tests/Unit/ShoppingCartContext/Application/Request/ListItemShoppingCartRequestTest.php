<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Request;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\RequestProvider;
use Challenge\ShoppingCartContext\Application\DTO\CartIdDto;
use Challenge\ShoppingCartContext\Application\Request\ListItemShoppingCartRequest;

final class ListItemShoppingCartRequestTest extends TestCase
{
    private readonly ListItemShoppingCartRequest $listItemShoppingCartRequest;

    protected function setUp(): void
    {
        $this->listItemShoppingCartRequest = new ListItemShoppingCartRequest();

        parent::setUp();
    }

    /**
     * @dataProvider provideListItemsRequest
     */
    public function testListItemShoppingCartRequest(string $request, CartIdDto $cartIdDto): void
    {
        $response = ($this->listItemShoppingCartRequest)($request);
        $this->assertEquals($cartIdDto, $response);
        $this->assertInstanceOf(CartIdDto::class, $response);
    }

    public static function provideListItemsRequest(): array
    {
        return RequestProvider::provideListItemsRequest();
    }
}
