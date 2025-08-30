<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Domain\Exception;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\ExceptionDomainProvider;
use Challenge\ShoppingCartContext\Domain\ValueObject\AmountValue;
use Challenge\ShoppingCartContext\Domain\Exception\InvalidAmountException;

final class InvalidAmountExceptionTest extends TestCase
{
    /**
     * @dataProvider provideInvalidAmountException
     */
    public function testInvalidAmountException(float $amount): void
    {
        $this->expectException(InvalidAmountException::class);
        new AmountValue($amount);
    }

    public static function provideInvalidAmountException(): array
    {
        return ExceptionDomainProvider::provideInvalidAmountException();
    }
}
