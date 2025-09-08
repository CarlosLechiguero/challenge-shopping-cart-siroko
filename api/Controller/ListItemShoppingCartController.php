<?php

declare(strict_types=1);

namespace Challenge\Api\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Challenge\SharedContext\Application\Bus\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Challenge\ShoppingCartContext\Application\Query\ListItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Request\ListItemShoppingCartRequest;
use Challenge\ShoppingCartContext\Application\Response\ListItemShoppingCartResponse;
use Challenge\ShoppingCartContext\Application\Service\Parser\ListItemShoppingCartParser;


final class ListItemShoppingCartController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface           $queryBus,
        private readonly ListItemShoppingCartRequest $listItemShoppingCartRequest,
        private readonly ListItemShoppingCartParser  $listItemShoppingCartParser,
    )
    {
    }

    public function __invoke(Request $request): Response
    {
        $cartId = ($this->listItemShoppingCartParser)(($this->listItemShoppingCartRequest)($request->attributes->get('cartId')));
        /** @var ListItemShoppingCartResponse $response */
        $response = $this->queryBus->ask(new ListItemShoppingCartQuery($cartId));
        
        return new Response(
            json_encode($response->getResponse()),
            Response::HTTP_OK
        );
    }
}
