<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Domain\Exception;

final class ProductNotFoundException extends \DomainException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
