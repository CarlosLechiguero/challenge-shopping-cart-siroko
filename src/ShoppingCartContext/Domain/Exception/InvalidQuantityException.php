<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\Exception;

final class InvalidQuantityException extends \DomainException
{
    public function __construct(string $message = 'Invalid quantity provided')
    {
        parent::__construct($message);
    }
}
