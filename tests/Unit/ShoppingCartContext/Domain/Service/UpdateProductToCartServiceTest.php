<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Domain\Service;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\ServiceDomainProvider;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;
use Challenge\ShoppingCartContext\Domain\Service\UpdateProductToCartService;

final class UpdateProductToCartServiceTest extends TestCase
{
    private readonly UpdateProductToCartService $updateProductFromCartService;
    protected function setUp(): void
    {
        $this->updateProductFromCartService = new UpdateProductToCartService();
        
        parent::setUp();
    }

    /**
     * @dataProvider provideUpdateProductToCartService
     */
    public function testUpdateProductToCartService(ShoppingCart $cart, ProductId $productId, QuantityValue $quantity): void
    {
        ($this->updateProductFromCartService)($cart, $productId, $quantity);

        $updatedItem = null;
        foreach ($cart->items() as $item) {
            if ($item->productId->equals($productId)) {
                $updatedItem = $item;
                break;
            }
        }   

        $this->assertNotNull($updatedItem);
        $this->assertEquals($quantity->getQuantity(), $updatedItem->getQuantity()->getQuantity());
    }

    public static function provideUpdateProductToCartService(): array
    {
        return ServiceDomainProvider::provideUpdateProductToCartService();
    }
}
