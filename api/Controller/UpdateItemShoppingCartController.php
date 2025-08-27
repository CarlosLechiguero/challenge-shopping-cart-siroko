<?php

declare(strict_types=1);

namespace Challenge\Api\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Challenge\SharedContext\Application\Bus\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Challenge\ShoppingCartContext\Application\Query\UpdateItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Handler\UpdateItemShoppingCartHandler;
use Challenge\ShoppingCartContext\Application\Request\UpdateItemShoppingCartRequest;
use Challenge\ShoppingCartContext\Application\Response\UpdateItemShoppingCartResponse;


final class UpdateItemShoppingCartController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly UpdateItemShoppingCartRequest $updateItemShoppingCartRequest,
        private readonly UpdateItemShoppingCartHandler $updateItemShoppingCartHandler,
    )
    {

    }

    public function __invoke(Request $request): Response
    {
        $shoppingCart = ($this->updateItemShoppingCartRequest)($request->getContent());
        /** @var UpdateItemShoppingCartResponse $response */
        $response = $this->updateItemShoppingCartHandler->handle(new UpdateItemShoppingCartQuery($shoppingCart));

        return new Response(
            json_encode($response->getResponse()),
            Response::HTTP_OK
        );
    }
}
