<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Handler;

use PHPUnit\Framework\TestCase;


use Challenge\Test\Provider\HandlerProvider;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\Service\AddProductToCartService;
use Challenge\ShoppingCartContext\Domain\Repository\ShoppingCartRepository;
use Challenge\ShoppingCartContext\Application\Query\AddItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Handler\AddItemShoppingCartHandler;
use Challenge\ShoppingCartContext\Application\Response\AddItemShoppingCartResponse;

final class AddItemShoppingCartHandlerTest extends TestCase
{

    private readonly ShoppingCartRepository $shoppingCartRepository;
    private readonly AddProductToCartService $addProductToCartService;
    private readonly AddItemShoppingCartHandler $addProductToCartHandler;

    protected function setUp(): void
    {
        $this->shoppingCartRepository = $this->createMock(ShoppingCartRepository::class);
        $this->addProductToCartService = new AddProductToCartService();
        $this->addProductToCartHandler = new AddItemShoppingCartHandler(
            $this->shoppingCartRepository,
            $this->addProductToCartService
        );
        
        parent::setUp();
    }

    /**
     * @dataProvider provideAddCartItem
     */
    public function testAddItemShoppingCartHandler(
        AddItemShoppingCartQuery $query,
        ?ShoppingCart $existingCart,
        ShoppingCart $expectedCart
    ): void {
        $this->shoppingCartRepository
            ->method('find')
            ->with($query->shoppingCart->id)
            ->willReturn($existingCart);

        $response = $this->addProductToCartHandler->handle($query);

        $this->assertInstanceOf(AddItemShoppingCartResponse::class, $response);

        $finalCart = $response->shoppingCart;
        $this->assertEquals($expectedCart, $finalCart);

    }

    public static function provideAddCartItem(): array
    {
        return HandlerProvider::provideAddCartItem();
    }
}
