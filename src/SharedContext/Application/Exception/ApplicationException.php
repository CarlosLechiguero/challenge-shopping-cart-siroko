<?php

declare(strict_types=1);

namespace Challenge\SharedContext\Application\Exception;

use Exception;

class ApplicationException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}