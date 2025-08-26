<?php

declare(strict_types=1);

namespace Challenge\SharedContext\Infrastructure\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Challenge\SharedContext\Application\Exception\ApplicationException;
use Challenge\SharedContext\Domain\Exception\DomainException;
use Challenge\SharedContext\Infrastructure\Exception\InfrastructureException;

class ApiExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $statusCode = 500;
        if ($exception instanceof HttpExceptionInterface) {
            $statusCode = $exception->getStatusCode();
        }

        if ($exception instanceof ApplicationException) {
            $statusCode = 400; 
        }
        
        if ($exception instanceof DomainException) {
            $statusCode = 422; 
        }
        
        if ($exception instanceof InfrastructureException) {
            $statusCode = 500;
        }

        $response = new JsonResponse([
            'error' => true,
            'message' => $exception->getMessage(),
        ], $statusCode);

        $event->setResponse($response);
    }
}
