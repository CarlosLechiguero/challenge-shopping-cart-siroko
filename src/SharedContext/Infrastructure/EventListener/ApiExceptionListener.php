<?php

declare(strict_types=1);

namespace Challenge\SharedContext\Infrastructure\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ApiExceptionListener
{

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        dd($exception);
        // Establecemos código HTTP
        $statusCode = $exception instanceof HttpExceptionInterface
            ? $exception->getStatusCode()
            : 500;

        $response = new JsonResponse([
            'error' => true,
            'message' => $exception->getMessage(),
        ], $statusCode);

        $event->setResponse($response);
    }
}
