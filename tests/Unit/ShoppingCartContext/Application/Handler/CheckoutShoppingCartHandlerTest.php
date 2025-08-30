<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Handler;

use Challenge\ShoppingCartContext\Domain\Entity\OrderShoppingCart;
use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\HandlerProvider;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\Repository\ShoppingCartRepository;
use Challenge\ShoppingCartContext\Application\Query\CheckoutShoppingCartQuery;
use Challenge\ShoppingCartContext\Domain\Repository\OrderShoppingCartRepository;
use Challenge\ShoppingCartContext\Application\Handler\CheckoutShoppingCartHandler;
use Challenge\ShoppingCartContext\Application\Response\CheckoutShoppingCartResponse;
use Challenge\ShoppingCartContext\Domain\Service\CalculateShoppingCartAmountService;



final class CheckoutShoppingCartHandlerTest extends TestCase
{
    private readonly ShoppingCartRepository             $shoppingCartRepository;
    private readonly OrderShoppingCartRepository        $orderShoppingCartRepository;
    private readonly CalculateShoppingCartAmountService $calculateShoppingCartAmountService;
    private readonly CheckoutShoppingCartHandler        $checkoutShoppingCartHandler;

    protected function setUp(): void
    {
        $this->shoppingCartRepository = $this->createMock(ShoppingCartRepository::class);
        $this->orderShoppingCartRepository = $this->createMock(OrderShoppingCartRepository::class);
        $this->calculateShoppingCartAmountService = new CalculateShoppingCartAmountService();

        $this->checkoutShoppingCartHandler = new CheckoutShoppingCartHandler(
            $this->shoppingCartRepository,
            $this->orderShoppingCartRepository,
            $this->calculateShoppingCartAmountService,
        );
            
        parent::setUp();
    }
    
    /**
     * @dataProvider provideCheckoutOrder
     */
    public function testCheckoutShoppingCartHandler(CheckoutShoppingCartQuery $query, ShoppingCart $existingCart): void
    {
        $this->shoppingCartRepository
            ->method('find')
            ->with($query->cartId)
            ->willReturn($existingCart);

        /** @var  CheckoutShoppingCartResponse $response */
        $response = $this->checkoutShoppingCartHandler->handle($query);

        $this->assertInstanceOf(CheckoutShoppingCartResponse::class, $response);
        $this->assertNotNull($response->orderShoppingCart->id->value);
        $this->assertEquals($response->orderShoppingCart->cart, $existingCart);
    }

    public static function provideCheckoutOrder(): array
    {
        return HandlerProvider::provideCheckoutOrder();
    }
}
