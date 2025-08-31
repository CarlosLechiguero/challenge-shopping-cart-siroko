<?php

declare(strict_types=1);

namespace Challenge\Api\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Challenge\SharedContext\Domain\Exception\DomainException;
use Challenge\SharedContext\Application\Response\ErrorResponse;
use Challenge\SharedContext\Application\Exception\ApplicationException;

class ApiExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        if ($exception instanceof ApplicationException) {
            $statusCode = Response::HTTP_BAD_REQUEST; 
        }
        
        if ($exception instanceof DomainException) {
            $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY; 
        }
        
        $response = new ErrorResponse( $exception->getMessage());
        $event->setResponse(new Response(
            json_encode($response->getResponse()),
            $statusCode
        ));
    }
}
