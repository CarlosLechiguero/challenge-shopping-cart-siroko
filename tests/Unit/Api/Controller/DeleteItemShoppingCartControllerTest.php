<?php

declare(strict_types=1);

namespace Challenge\Test\Api\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Challenge\Test\Provider\ControllerProvider;
use Challenge\Api\Controller\DeleteItemShoppingCartController;
use Challenge\SharedContext\Application\Bus\QueryBusInterface;
use Challenge\SharedContext\Application\Response\AbstractResponse;
use Challenge\ShoppingCartContext\Application\Query\DeleteItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Request\DeleteItemShoppingCartRequest;
use Challenge\ShoppingCartContext\Application\Service\Parser\DeleteItemShoppingCartParser;

final class DeleteItemShoppingCartControllerTest extends TestCase
{
    private readonly QueryBusInterface $queryBus;
    private readonly DeleteItemShoppingCartRequest $deleteItemShoppingCartRequest;
    private readonly DeleteItemShoppingCartParser  $deleteItemShoppingCartParser;
    private readonly DeleteItemShoppingCartController $controller;
    protected function setUp(): void
    {
        $this->queryBus = $this->createMock(QueryBusInterface::class);
        $this->deleteItemShoppingCartRequest = new DeleteItemShoppingCartRequest();
        $this->deleteItemShoppingCartParser = new DeleteItemShoppingCartParser();
        $this->controller = new DeleteItemShoppingCartController(
            $this->queryBus, 
            $this->deleteItemShoppingCartRequest,
            $this->deleteItemShoppingCartParser,
        );

        parent::setUp();
    }

    /**
     * @dataProvider provideDeleteItemShoppingCartController
     */
    public function testDeleteItemShoppingCartController(Request $request, AbstractResponse $responseClass): void
    {
        $this->queryBus
            ->method('ask')
            ->with($this->isInstanceOf(DeleteItemShoppingCartQuery::class))
            ->willReturn($responseClass);

        $response = ($this->controller)($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public static function provideDeleteItemShoppingCartController(): array
    {
        return ControllerProvider::provideDeleteItemShoppingCartController();
    }
}
