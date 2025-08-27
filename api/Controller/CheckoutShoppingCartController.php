<?php

declare(strict_types=1);

namespace Challenge\Api\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Challenge\SharedContext\Application\Bus\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Challenge\ShoppingCartContext\Application\Query\CheckoutShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Handler\CheckoutShoppingCartHandler;
use Challenge\ShoppingCartContext\Application\Request\CheckoutShoppingCartRequest;
use Challenge\ShoppingCartContext\Application\Response\CheckoutShoppingCartResponse;

final class CheckoutShoppingCartController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly CheckoutShoppingCartRequest $checkoutShoppingCartRequest,
        private readonly CheckoutShoppingCartHandler $checkoutShoppingCartHandler,
    )
    {

    }

    public function __invoke(Request $request): Response
    {       
        $orderShoppingCart = ($this->checkoutShoppingCartRequest)($request->getContent());
        /** @var CheckoutShoppingCartResponse $response */
        $response = $this->checkoutShoppingCartHandler->handle(new CheckoutShoppingCartQuery($orderShoppingCart));

        return new Response(
            json_encode($response->getResponse()),
            Response::HTTP_OK
        );
    }
}
