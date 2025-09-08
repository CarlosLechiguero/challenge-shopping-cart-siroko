<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Handler;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\HandlerProvider;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\Repository\ShoppingCartRepository;
use Challenge\ShoppingCartContext\Application\Query\ListItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Handler\ListItemShoppingCartHandler;
use Challenge\ShoppingCartContext\Application\Response\ListItemShoppingCartResponse;


final class ListItemShoppingCartHandlerTest extends TestCase
{

    private readonly ShoppingCartRepository $shoppingCartRepository;
    private readonly ListItemShoppingCartHandler $listItemShoppingCartHandler;

    protected function setUp(): void
    {
        $this->shoppingCartRepository = $this->createMock(ShoppingCartRepository::class);

        $this->listItemShoppingCartHandler = new ListItemShoppingCartHandler(
            $this->shoppingCartRepository,
        );
            
        parent::setUp();
    }

    /**
     * @dataProvider provideListItems
     */
    public function testListItemShoppingCartHandler(ListItemShoppingCartQuery $query, ShoppingCart $existingCart): void
    {
        $this->shoppingCartRepository
            ->method('find')
            ->with($query->cartId)
            ->willReturn($existingCart);

        $response = $this->listItemShoppingCartHandler->handle($query);

        $this->assertInstanceOf(ListItemShoppingCartResponse::class, $response);
    }

    public static function provideListItems(): array
    {
        return HandlerProvider::provideListItems();
    }
}
