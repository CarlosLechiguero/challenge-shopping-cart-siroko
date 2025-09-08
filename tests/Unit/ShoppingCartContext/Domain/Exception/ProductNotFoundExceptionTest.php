<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Domain\Exception;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\ExceptionDomainProvider;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;
use Challenge\ShoppingCartContext\Domain\Exception\ProductNotFoundException;
use Challenge\ShoppingCartContext\Domain\Service\UpdateProductToCartService;
use Challenge\ShoppingCartContext\Domain\Service\RemoveProductFromCartService;

final class ProductNotFoundExceptionTest extends TestCase
{

    private readonly RemoveProductFromCartService $removeProductFromCartService;
    private readonly UpdateProductToCartService $updateProductFromCartService;
    protected function setUp(): void
    {
        $this->removeProductFromCartService = new RemoveProductFromCartService();
        $this->updateProductFromCartService = new UpdateProductToCartService();

        parent::setUp();
    }

    /**
     * @dataProvider provideProductNotFoundExceptionUpdateService
     */
    public function testProductNotFoundExceptionUpdateService(ShoppingCart $cart, ProductId $productId, QuantityValue $quantity): void
    {
        $this->expectException(ProductNotFoundException::class);
        ($this->updateProductFromCartService)($cart, $productId, $quantity);
    }
    /**
     * @dataProvider provideProductNotFoundExceptionRemoveService
     */
    public function testProductNotFoundExceptionRemoveService(ShoppingCart $cart, ProductId $productId): void
    {
        $this->expectException(ProductNotFoundException::class);
        ($this->removeProductFromCartService)($cart, $productId);
    }



    public static function provideProductNotFoundExceptionUpdateService(): array
    {
        return ExceptionDomainProvider::provideProductNotFoundExceptionUpdateService();
    }

    public static function provideProductNotFoundExceptionRemoveService(): array
    {
        return ExceptionDomainProvider::provideProductNotFoundExceptionRemoveService();
    }
}
