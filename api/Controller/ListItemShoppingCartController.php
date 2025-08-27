<?php

declare(strict_types=1);

namespace Challenge\Api\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Challenge\SharedContext\Application\Bus\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Challenge\ShoppingCartContext\Application\Query\ListItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Handler\ListItemShoppingCartHandler;
use Challenge\ShoppingCartContext\Application\Request\ListItemShoppingCartRequest;
use Challenge\ShoppingCartContext\Application\Response\ListItemShoppingCartResponse;


final class ListItemShoppingCartController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly ListItemShoppingCartRequest $listItemShoppingCartRequest,
        private readonly ListItemShoppingCartHandler $listItemShoppingCartHandler,
    )
    {
    }

    public function __invoke(Request $request): Response
    {
        $shoppingCart = ($this->listItemShoppingCartRequest)($request->getContent());
        /** @var ListItemShoppingCartResponse $response */
        $response = $this->listItemShoppingCartHandler->handle(new ListItemShoppingCartQuery($shoppingCart));
        
        return new Response(
            json_encode($response->getResponse()),
            Response::HTTP_OK
        );
    }
}
