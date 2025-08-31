<?php

declare(strict_types=1);

namespace Challenge\SharedContext\Application\Response;

abstract class AbstractResponse
{
    public function __construct(
        public readonly bool $success = true,
        private ?string $errorMessage = "",
    )
    {
    }

    abstract protected function getData(): array;

    public function getResponse(): array
    {
        return [
            'success' => $this->success,
            'errorMessage' => $this->errorMessage,
            'data' => $this->getData(),
        ];
    }
}
