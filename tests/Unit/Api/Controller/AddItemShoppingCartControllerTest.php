<?php

declare(strict_types=1);

namespace Challenge\Test\Api\Controller;

use Challenge\SharedContext\Application\Response\AbstractResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Challenge\Test\Provider\ControllerProvider;
use Challenge\Api\Controller\AddItemShoppingCartController;
use Challenge\SharedContext\Application\Bus\QueryBusInterface;
use Challenge\ShoppingCartContext\Application\Query\AddItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Request\AddItemShoppingCartRequest;
use Challenge\ShoppingCartContext\Application\Service\Parser\AddItemShoppingCartParser;

final class AddItemShoppingCartControllerTest extends TestCase
{

    private readonly QueryBusInterface          $queryBus;
    private readonly AddItemShoppingCartRequest $addItemShoppingCartRequest;
    private readonly AddItemShoppingCartParser  $addItemShoppingCartParser;
    private readonly AddItemShoppingCartController $controller;

    protected function setUp(): void
    {
        $this->queryBus = $this->createMock(QueryBusInterface::class);
        $this->addItemShoppingCartRequest = new AddItemShoppingCartRequest();
        $this->addItemShoppingCartParser = new AddItemShoppingCartParser();
        $this->controller = new AddItemShoppingCartController(
            $this->queryBus, 
            $this->addItemShoppingCartRequest,
            $this->addItemShoppingCartParser,
        );
        parent::setUp();
    }

    /**
     * @dataProvider provideAddItemShoppingCartController
     */
    public function testAddItemShoppingCartController(Request $request, AbstractResponse $responseClass): void
    {
        $this->queryBus
            ->method('ask')
            ->with($this->isInstanceOf(AddItemShoppingCartQuery::class))
            ->willReturn($responseClass);

        $response = ($this->controller)($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

    }

    public static function provideAddItemShoppingCartController(): array
    {
        return ControllerProvider::provideAddItemShoppingCartController();
    }
}
