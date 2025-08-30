<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Handler;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\HandlerProvider;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\Repository\ShoppingCartRepository;
use Challenge\ShoppingCartContext\Domain\Service\UpdateProductToCartService;
use Challenge\ShoppingCartContext\Application\Query\UpdateItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Handler\UpdateItemShoppingCartHandler;
use Challenge\ShoppingCartContext\Application\Response\UpdateItemShoppingCartResponse;


final class UpdateItemShoppingCartHandlerTest extends TestCase
{
    private readonly ShoppingCartRepository $shoppingCartRepository;
    private readonly UpdateProductToCartService $updateProductFromCartService;
    private readonly UpdateItemShoppingCartHandler $updateItemShoppingCartHandler;

    protected function setUp(): void
    {
        $this->shoppingCartRepository = $this->createMock(ShoppingCartRepository::class);
        $this->updateProductFromCartService = new UpdateProductToCartService();
        $this->updateItemShoppingCartHandler = new UpdateItemShoppingCartHandler(
            $this->shoppingCartRepository,
            $this->updateProductFromCartService
        );
            
        parent::setUp();
    }

    /**
     * @dataProvider provideUpdateCartitem
     */
    public function testUpdateItemShoppingCartHandler(UpdateItemShoppingCartQuery $query, ShoppingCart $existingCart): void
    {
        $this->shoppingCartRepository
            ->method('find')
            ->with($query->shoppingCart->id)
            ->willReturn($existingCart);

        $response = $this->updateItemShoppingCartHandler->handle($query);

        $this->assertInstanceOf(UpdateItemShoppingCartResponse::class, $response);
    }

    public static function provideUpdateCartitem(): array
    {
        return HandlerProvider::provideUpdateCartitem();
    }

    
}
