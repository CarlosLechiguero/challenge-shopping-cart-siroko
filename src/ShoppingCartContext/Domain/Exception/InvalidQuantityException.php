<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\Exception;

use Challenge\SharedContext\Domain\Exception\DomainException;

final class InvalidQuantityException extends DomainException
{
    public function __construct(string $message = 'Invalid quantity')
    {
        parent::__construct($message);
    }
}
