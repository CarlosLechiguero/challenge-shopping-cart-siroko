<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Domain\Service;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\ServiceDomainProvider;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;
use Challenge\ShoppingCartContext\Domain\Service\AddProductToCartService;

final class AddProductToCartServiceTest extends TestCase
{
    private readonly AddProductToCartService $addProductToCartService;
    protected function setUp(): void
    {
        $this->addProductToCartService = new AddProductToCartService();
        parent::setUp();
    }

    /**
     * @dataProvider provideAddProductToCartService
     */
    public function testAddProductToCartService(ShoppingCart $cart, ProductId $productId, QuantityValue $quantity): void
    {
        ($this->addProductToCartService)($cart, $productId, $quantity);

        $this->assertCount(
            count($cart->items()), 
            array_filter($cart->items(), fn($item) => $item->productId->equals($productId))
        );

        
        $addedItem = null;
        foreach ($cart->items() as $item) {
            if ($item->productId->equals($productId)) {
                $addedItem = $item;
                break;
            }
        }

        $this->assertNotNull($addedItem);
    }

    public static function provideAddProductToCartService(): array
    {
        return ServiceDomainProvider::provideAddProductToCartService();
    }
}
