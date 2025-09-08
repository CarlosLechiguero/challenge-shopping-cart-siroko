<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\Exception;

use Challenge\SharedContext\Domain\Exception\DomainException;

final class InvalidAmountException extends DomainException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
