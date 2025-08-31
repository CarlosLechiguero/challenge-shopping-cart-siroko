<?php

declare(strict_types=1);

namespace Challenge\SharedContext\Infrastructure\Exception;

use Exception;

class InfrastructureException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
