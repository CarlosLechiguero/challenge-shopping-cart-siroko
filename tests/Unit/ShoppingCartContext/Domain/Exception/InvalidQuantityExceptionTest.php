<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Domain\Exception;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\ExceptionDomainProvider;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;
use Challenge\ShoppingCartContext\Domain\Exception\InvalidQuantityException;

final class InvalidQuantityExceptionTest extends TestCase
{
    /**
     * @dataProvider provideInvalidQuantityException
     */
    public function testInvalidQuantityException(int $quantity): void
    {
        $this->expectException(InvalidQuantityException::class);
        new QuantityValue($quantity);
    }

    public static function provideInvalidQuantityException(): array
    {
        return ExceptionDomainProvider::provideInvalidQuantityException();
    }
}
