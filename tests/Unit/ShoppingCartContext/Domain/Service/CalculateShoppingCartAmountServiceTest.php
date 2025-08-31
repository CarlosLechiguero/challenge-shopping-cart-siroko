<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Domain\Service;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\ServiceDomainProvider;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\AmountValue;
use Challenge\ShoppingCartContext\Domain\Service\CalculateShoppingCartAmountService;

final class CalculateShoppingCartAmountServiceTest extends TestCase
{
    private readonly CalculateShoppingCartAmountService $calculateShoppingCartAmountService;
    protected function setUp(): void
    {

        $this->calculateShoppingCartAmountService = new CalculateShoppingCartAmountService();
        parent::setUp();
    }

    /**
     * @dataProvider provideCalculateShoppingCartAmountService
     */
    public function testCalculateShoppingCartAmountService(ShoppingCart $cart): void
    {
        $response = ($this->calculateShoppingCartAmountService)($cart);
        $this->assertInstanceOf(AmountValue::class, $response);
    }

    public static function provideCalculateShoppingCartAmountService(): array
    {
        return ServiceDomainProvider::provideCalculateShoppingCartAmountService();
    }
}
