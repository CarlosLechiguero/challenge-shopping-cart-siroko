<?php

declare(strict_types=1);

namespace Challenge\Test\Api\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Challenge\Test\Provider\ControllerProvider;
use Challenge\Api\Controller\UpdateItemShoppingCartController;
use Challenge\SharedContext\Application\Bus\QueryBusInterface;
use Challenge\SharedContext\Application\Response\AbstractResponse;
use Challenge\ShoppingCartContext\Application\Query\UpdateItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Request\UpdateItemShoppingCartRequest;
use Challenge\ShoppingCartContext\Application\Service\Parser\UpdateItemShoppingCartParser;

final class UpdateItemShoppingCartControllerTesst extends TestCase
{
    private readonly QueryBusInterface             $queryBus;
    private readonly UpdateItemShoppingCartRequest $updateItemShoppingCartRequest;
    private readonly UpdateItemShoppingCartParser  $uppdateItemShoppingCartParser;
    private readonly UpdateItemShoppingCartController $controller;

    protected function setUp(): void
    {
        $this->queryBus = $this->createMock(QueryBusInterface::class);
        $this->updateItemShoppingCartRequest = new UpdateItemShoppingCartRequest();
        $this->uppdateItemShoppingCartParser = new UpdateItemShoppingCartParser();
        $this->controller = new UpdateItemShoppingCartController(
            $this->queryBus, 
            $this->updateItemShoppingCartRequest,
            $this->uppdateItemShoppingCartParser,
        );
        
        parent::setUp();
    }

    /**
     * @dataProvider provideUpdateItemShoppingCartController
     */
    public function testUpdateItemShoppingCartController(Request $request, AbstractResponse $responseClass): void
    {
        $this->queryBus
            ->method('ask')
            ->with($this->isInstanceOf(UpdateItemShoppingCartQuery::class))
            ->willReturn($responseClass);

        $response = ($this->controller)($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public static function provideUpdateItemShoppingCartController(): array
    {
        return ControllerProvider::provideUpdateItemShoppingCartController();
    }
}
