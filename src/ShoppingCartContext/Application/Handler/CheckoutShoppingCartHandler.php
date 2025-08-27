<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Handler;

use Challenge\SharedContext\Application\Response\AbstractResponse;
use Challenge\SharedContext\Application\Query\QueryHandlerInterface;
use Challenge\ShoppingCartContext\Domain\Repository\ShoppingCartRepository;
use Challenge\ShoppingCartContext\Application\Query\CheckoutShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Response\CheckoutShoppingCartResponse;


final class CheckoutShoppingCartHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ShoppingCartRepository $shoppingCartRepository,
    ) {}
    
    /**
     * Summary of handle
     * @param CheckoutShoppingCartQuery $query
     */
    public function handle(CheckoutShoppingCartQuery $query): AbstractResponse
    {




        return new CheckoutShoppingCartResponse();
    }
}
