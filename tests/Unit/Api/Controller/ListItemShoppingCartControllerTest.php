<?php

declare(strict_types=1);

namespace Challenge\Test\Api\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Challenge\Test\Provider\ControllerProvider;
use Challenge\Api\Controller\ListItemShoppingCartController;
use Challenge\SharedContext\Application\Bus\QueryBusInterface;
use Challenge\SharedContext\Application\Response\AbstractResponse;
use Challenge\ShoppingCartContext\Application\Query\ListItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Request\ListItemShoppingCartRequest;
use Challenge\ShoppingCartContext\Application\Service\Parser\ListItemShoppingCartParser;

final class ListItemShoppingCartControllerTest extends TestCase
{
    private readonly QueryBusInterface           $queryBus;
    private readonly ListItemShoppingCartRequest $listItemShoppingCartRequest;
    private readonly ListItemShoppingCartParser  $listItemShoppingCartParser;
    private readonly ListItemShoppingCartController $controller;

    protected function setUp(): void
    {
        $this->queryBus = $this->createMock(QueryBusInterface::class);
        $this->listItemShoppingCartRequest = new ListItemShoppingCartRequest();
        $this->listItemShoppingCartParser = new ListItemShoppingCartParser();
        $this->controller = new ListItemShoppingCartController(
            $this->queryBus, 
            $this->listItemShoppingCartRequest,
            $this->listItemShoppingCartParser,
        );
        parent::setUp();
    }

    /**
     * @dataProvider provideListItemShoppingCartController
     */
    public function testListItemShoppingCartController(Request $request, AbstractResponse $responseClass): void
    {
        $this->queryBus
            ->method('ask')
            ->with($this->isInstanceOf(ListItemShoppingCartQuery::class))
            ->willReturn($responseClass);

        $response = ($this->controller)($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public static function provideListItemShoppingCartController(): array
    {
        return ControllerProvider::provideListItemShoppingCartController();
    }
}
