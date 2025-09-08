<?php

declare(strict_types=1);

namespace Challenge\Test\ShoppingCartContext\Domain\Exception;

use PHPUnit\Framework\TestCase;
use Challenge\Test\Provider\ExceptionDomainProvider;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\ValueObject\OrderId;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\Exception\InvalidIdException;

final class InvalidIdExceptionTest extends TestCase
{
    /**
     * @dataProvider provideInvalidIdException
     */
    public function testInvalidIdExceptionCartId(string $value): void
    {
        $this->expectException(InvalidIdException::class);
        new CartId($value);
        
    }

    /**
     * @dataProvider provideInvalidIdException
     */
    public function testInvalidIdExceptionProductId(string $value): void
    {
        $this->expectException(InvalidIdException::class);
        new ProductId($value);
    }

    /**
     * @dataProvider provideInvalidIdException
     */
    public function testInvalidIdExceptionOrderId(string $value): void
    {
        $this->expectException(InvalidIdException::class);
        new OrderId($value);
    }

    public static function provideInvalidIdException(): array
    {
        return ExceptionDomainProvider::provideInvalidIdException();
    }
}
