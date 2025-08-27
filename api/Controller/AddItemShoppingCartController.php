<?php

declare(strict_types=1);

namespace Challenge\Api\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Challenge\SharedContext\Application\Bus\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Challenge\ShoppingCartContext\Application\Query\AddItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Handler\AddItemShoppingCartHandler;
use Challenge\ShoppingCartContext\Application\Request\AddItemShoppingCartRequest;
use Challenge\ShoppingCartContext\Application\Response\AddItemShoppingCartResponse;

final class AddItemShoppingCartController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly AddItemShoppingCartRequest $addItemShoppingCartRequest,
        private readonly AddItemShoppingCartHandler $addItemShoppingCartHandler,
    )
    {

    }

    public function __invoke(Request $request): Response
    {       
        $shoppingCart = ($this->addItemShoppingCartRequest)($request->getContent());
        /** @var AddItemShoppingCartResponse $response */
        $response = $this->addItemShoppingCartHandler->handle(new AddItemShoppingCartQuery($shoppingCart));

        return new Response(
            json_encode($response->getResponse()),
            Response::HTTP_OK
        );
    }
}
