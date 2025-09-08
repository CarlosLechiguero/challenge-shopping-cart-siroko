<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Exception;

use Challenge\SharedContext\Application\Exception\ApplicationException;

final class InvalidRequestException extends ApplicationException
{
    public function __construct(string $message = "Invalid request") {
        parent::__construct($message);
    }
}
