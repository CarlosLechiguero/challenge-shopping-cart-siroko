<?php

declare(strict_types=1);

namespace Challenge\Api\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Challenge\SharedContext\Application\Bus\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Challenge\ShoppingCartContext\Application\Query\DeleteItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Service\Parser\DeleteItemShoppingCartParser;
use Challenge\ShoppingCartContext\Application\Request\DeleteItemShoppingCartRequest;
use Challenge\ShoppingCartContext\Application\Response\DeleteItemShoppingCartResponse;

final class DeleteItemShoppingCartController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly DeleteItemShoppingCartRequest $deleteItemShoppingCartRequest,
        private readonly DeleteItemShoppingCartParser  $deleteItemShoppingCartParser,
    )
    {

    }

    public function __invoke(Request $request): Response
    {
        $deleteItem = ($this->deleteItemShoppingCartParser)(($this->deleteItemShoppingCartRequest)($request->getContent()));
        /** @var DeleteItemShoppingCartResponse $response */
        $response = $this->queryBus->ask(new DeleteItemShoppingCartQuery($deleteItem));

        return new Response(
            json_encode($response->getResponse()),
            Response::HTTP_OK
        );
    }
}
