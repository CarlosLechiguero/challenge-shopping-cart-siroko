<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Domain\Service;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\ServiceDomainProvider;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\Service\RemoveProductFromCartService;

final class RemoveProductFromCartServiceTest extends TestCase
{
    private readonly RemoveProductFromCartService $removeProductFromCartService;
    protected function setUp(): void
    {

        $this->removeProductFromCartService = new RemoveProductFromCartService();
        parent::setUp();
    }

    /**
     * @dataProvider provideRemoveProductFromCartService
     */
    public function testRemoveProductFromCartService(ShoppingCart $cart, ProductId $productId): void
    {
        ($this->removeProductFromCartService)($cart, $productId);

        $deleteItem = null;
        foreach ($cart->items() as $item) {
            if ($item->productId->equals($productId)) {
                $deleteItem = $item;
                break;
            }
        }
        
        $this->assertNull($deleteItem);
    }

    public static function provideRemoveProductFromCartService(): array
    {
        return ServiceDomainProvider::provideRemoveProductFromCartService();
    }
}
