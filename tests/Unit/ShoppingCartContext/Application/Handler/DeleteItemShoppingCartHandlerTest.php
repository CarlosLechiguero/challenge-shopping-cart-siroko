<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Handler;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\HandlerProvider;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\Repository\ShoppingCartRepository;
use Challenge\ShoppingCartContext\Domain\Service\RemoveProductFromCartService;
use Challenge\ShoppingCartContext\Application\Query\DeleteItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Handler\DeleteItemShoppingCartHandler;
use Challenge\ShoppingCartContext\Application\Response\DeleteItemShoppingCartResponse;


final class DeleteItemShoppingCartHandlerTest extends TestCase
{

    private readonly ShoppingCartRepository $shoppingCartRepository;
    private readonly RemoveProductFromCartService $removeProductFromCartService;
    private readonly DeleteItemShoppingCartHandler  $deleteItemShoppingCartHandler;

    protected function setUp(): void
    {
        $this->shoppingCartRepository = $this->createMock(ShoppingCartRepository::class);
        $this->removeProductFromCartService = new RemoveProductFromCartService();

        $this->deleteItemShoppingCartHandler = new DeleteItemShoppingCartHandler(
            $this->shoppingCartRepository,
            $this->removeProductFromCartService,
        );
            
        parent::setUp();
    }

    /**
     * @dataProvider provideDeleteCartItem
     */
    public function testDeleteItemShoppingCartHandler(DeleteItemShoppingCartQuery $query, ShoppingCart $existingCart): void
    {
        $this->shoppingCartRepository
            ->method('find')
            ->with($query->deleteProductValue->cartId)
            ->willReturn($existingCart);
        
        /** @var DeleteItemShoppingCartResponse $response */
        $response = $this->deleteItemShoppingCartHandler->handle($query);

        $this->assertInstanceOf(DeleteItemShoppingCartResponse::class, $response);
    }

    public static function provideDeleteCartItem(): array
    {
        return HandlerProvider::provideDeleteCartItem();
    }
}
