<?php

declare(strict_types=1);

namespace Challenge\Test\Api\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Challenge\Test\Provider\ControllerProvider;
use Challenge\Api\Controller\CheckoutShoppingCartController;
use Challenge\SharedContext\Application\Bus\QueryBusInterface;
use Challenge\SharedContext\Application\Response\AbstractResponse;
use Challenge\ShoppingCartContext\Application\Query\CheckoutShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Request\CheckoutShoppingCartRequest;
use Challenge\ShoppingCartContext\Application\Service\Parser\CheckoutShoppingCartParser;

final class CheckoutShoppingCartControllerTest extends TestCase
{
    private readonly QueryBusInterface $queryBus;
    private readonly CheckoutShoppingCartRequest $checkoutShoppingCartRequest;
    private readonly CheckoutShoppingCartParser  $checkoutShoppingCartParser;
    private readonly CheckoutShoppingCartController $controller;
    protected function setUp(): void
    {
        $this->queryBus = $this->createMock(QueryBusInterface::class);
        $this->checkoutShoppingCartRequest = new CheckoutShoppingCartRequest();
        $this->checkoutShoppingCartParser = new CheckoutShoppingCartParser();
        $this->controller = new CheckoutShoppingCartController(
            $this->queryBus, 
            $this->checkoutShoppingCartRequest,
            $this->checkoutShoppingCartParser,
        );

        parent::setUp();
    }

    /**
     * @dataProvider provideCheckoutShoppingCartController
     */
    public function testCheckoutShoppingCartController(Request $request, AbstractResponse $responseClass): void
    {
        $this->queryBus
            ->method('ask')
            ->with($this->isInstanceOf(CheckoutShoppingCartQuery::class))
            ->willReturn($responseClass);

        $response = ($this->controller)($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public static function provideCheckoutShoppingCartController(): array
    {
        return ControllerProvider::provideCheckoutShoppingCartController();
    }
}
