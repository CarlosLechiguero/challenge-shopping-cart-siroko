<?php

declare(strict_types=1);

namespace Challenge\Api\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Challenge\SharedContext\Application\Bus\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Challenge\ShoppingCartContext\Application\Query\CheckoutShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Service\Parser\CheckoutShoppingCartParser;
use Challenge\ShoppingCartContext\Application\Request\CheckoutShoppingCartRequest;
use Challenge\ShoppingCartContext\Application\Response\CheckoutShoppingCartResponse;

final class CheckoutShoppingCartController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly CheckoutShoppingCartRequest $checkoutShoppingCartRequest,
        private readonly CheckoutShoppingCartParser  $checkoutShoppingCartParser,
    )
    {

    }

    public function __invoke(Request $request): Response
    {       
        $cartId = ($this->checkoutShoppingCartParser)(($this->checkoutShoppingCartRequest)($request->getContent()));
        /** @var CheckoutShoppingCartResponse $response */
        $response = $this->queryBus->ask(new CheckoutShoppingCartQuery($cartId));

        return new Response(
            json_encode($response->getResponse()),
            Response::HTTP_OK
        );
    }
}
