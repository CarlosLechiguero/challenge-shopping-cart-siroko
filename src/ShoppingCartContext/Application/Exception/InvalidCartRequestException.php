<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Exception;

use Challenge\SharedContext\Application\Exception\ApplicationException;

final class InvalidCartRequestException extends ApplicationException
{
    public function __construct(string $message) {
        parent::__construct($message, 400);
    }

    public static function missingField(string $field): self
    {
        return new self("The field $field is required.");
    }
}
