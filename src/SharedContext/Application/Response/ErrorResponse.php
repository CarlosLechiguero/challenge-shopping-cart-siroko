<?php

declare(strict_types=1);

namespace Challenge\SharedContext\Application\Response;

final class ErrorResponse extends AbstractResponse
{
    public function __construct(
        private ?string $errorMessage,
    )
    {
        parent::__construct(false, $this->errorMessage);
    }
    
    public function getData(): array
    {
        return [];
    }
}
