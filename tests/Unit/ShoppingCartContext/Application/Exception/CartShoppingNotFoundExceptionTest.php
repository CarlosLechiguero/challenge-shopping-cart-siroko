<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Application\Exception;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\ExceptionApplicationProvider;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\Repository\ShoppingCartRepository;
use Challenge\ShoppingCartContext\Domain\Service\UpdateProductToCartService;
use Challenge\ShoppingCartContext\Application\Query\CheckoutShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Query\ListItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Domain\Service\RemoveProductFromCartService;
use Challenge\ShoppingCartContext\Application\Query\DeleteItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Query\UpdateItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Domain\Repository\OrderShoppingCartRepository;
use Challenge\ShoppingCartContext\Application\Handler\CheckoutShoppingCartHandler;
use Challenge\ShoppingCartContext\Application\Handler\ListItemShoppingCartHandler;
use Challenge\ShoppingCartContext\Application\Handler\DeleteItemShoppingCartHandler;
use Challenge\ShoppingCartContext\Application\Handler\UpdateItemShoppingCartHandler;
use Challenge\ShoppingCartContext\Domain\Service\CalculateShoppingCartAmountService;
use Challenge\ShoppingCartContext\Application\Exception\CartShoppingNotFoundException;


final class CartShoppingNotFoundExceptionTest extends TestCase
{

    private readonly ShoppingCartRepository $shoppingCartRepository;
    private readonly OrderShoppingCartRepository $orderShoppingCartRepository;


    private readonly CheckoutShoppingCartHandler $checkoutShoppingCartHandler;
    private readonly DeleteItemShoppingCartHandler $deleteItemShoppingCartHandler;
    private readonly ListItemShoppingCartHandler $listItemShoppingCartHandler;
    private readonly UpdateItemShoppingCartHandler $updateItemShoppingCartHandler;
    protected function setUp(): void
    {
        $this->shoppingCartRepository = $this->createMock(ShoppingCartRepository::class);
        $this->orderShoppingCartRepository = $this->createMock(OrderShoppingCartRepository::class);

        $this->shoppingCartRepository
            ->method('find')
            ->with(new CartId('11111111-1111-1111-1111-111111111111'))
            ->willReturn(null);

        parent::setUp();
    }

    /**
     * @dataProvider provideCheckoutCartShoppingNotFoundException
     */
    public function testCheckoutCartShoppingNotFoundException(CheckoutShoppingCartQuery $query, string $responseApi): void
    {
        $calculateShoppingCartAmountService = new CalculateShoppingCartAmountService();
        $checkoutShoppingCartHandler = new CheckoutShoppingCartHandler(
            $this->shoppingCartRepository,
            $this->orderShoppingCartRepository,
            calculateShoppingCartAmountService: $calculateShoppingCartAmountService,
        );

        $this->expectException(CartShoppingNotFoundException::class);
        $this->expectExceptionMessage($responseApi);
        $checkoutShoppingCartHandler->handle($query);
    }

    /**
     * @dataProvider provideDeleteCartShoppingNotFoundException
     */
    public function testDeleteCartShoppingNotFoundException(DeleteItemShoppingCartQuery $query, string $responseApi): void
    {
        $removeProductFromCartService = new RemoveProductFromCartService();

        $deleteItemShoppingCartHandler = new DeleteItemShoppingCartHandler(
            $this->shoppingCartRepository,
            $removeProductFromCartService,
        );

        $this->expectException(CartShoppingNotFoundException::class);
        $this->expectExceptionMessage($responseApi);
        $deleteItemShoppingCartHandler->handle($query);
    }
    /**
     * @dataProvider provideListCartShoppingNotFoundException
     */
    public function testListCartShoppingNotFoundException(ListItemShoppingCartQuery $query, string $responseApi): void
    {
        $listItemShoppingCartHandler = new ListItemShoppingCartHandler(
            $this->shoppingCartRepository,
        );

        $this->expectException(CartShoppingNotFoundException::class);
        $this->expectExceptionMessage($responseApi);
         $listItemShoppingCartHandler->handle($query);


    }
    /**
     * @dataProvider provideUpdateCartShoppingNotFoundException
     */
    public function testUpdateCartShoppingNotFoundException(UpdateItemShoppingCartQuery $query, string $responseApi): void
    {
        $updateProductFromCartService = new UpdateProductToCartService();
        $updateItemShoppingCartHandler = new UpdateItemShoppingCartHandler(
            $this->shoppingCartRepository,
            $updateProductFromCartService
        );

        $this->expectException(CartShoppingNotFoundException::class);
        $this->expectExceptionMessage($responseApi);
        $updateItemShoppingCartHandler->handle($query);
    }


    public static function provideCheckoutCartShoppingNotFoundException(): array
    {
        return ExceptionApplicationProvider::provideCheckoutCartShoppingNotFoundException();
    }

    public static function provideDeleteCartShoppingNotFoundException(): array
    {
        return ExceptionApplicationProvider::provideDeleteCartShoppingNotFoundException();
    }

    public static function provideListCartShoppingNotFoundException(): array
    {
        return ExceptionApplicationProvider::provideListCartShoppingNotFoundException();
    }

    public static function provideUpdateCartShoppingNotFoundException(): array
    {
        return ExceptionApplicationProvider::provideUpdateCartShoppingNotFoundException();
    }
}
