<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Request;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\RequestProvider;
use Challenge\ShoppingCartContext\Application\DTO\CartIdDto;
use Challenge\ShoppingCartContext\Application\Request\CheckoutShoppingCartRequest;


final class CheckoutShoppingCartRequestTest extends TestCase
{
    private readonly CheckoutShoppingCartRequest $checkoutShoppingCartRequest;

    protected function setUp(): void
    {
        $this->checkoutShoppingCartRequest = new CheckoutShoppingCartRequest();

        parent::setUp();
    }

    /**
     * @dataProvider provideCheckoutRequest
     */
    public function testCheckoutShoppingCartRequest(string $request, CartIdDto $cartIdDto): void
    {
        $response = ($this->checkoutShoppingCartRequest)($request);
        $this->assertEquals($cartIdDto, $response);
        $this->assertInstanceOf(CartIdDto::class, $response);
    }

    public static function provideCheckoutRequest(): array
    {
        return RequestProvider::provideCheckoutRequest();
    }
}
