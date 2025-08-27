<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Handler;

use Challenge\SharedContext\Application\Response\AbstractResponse;
use Challenge\SharedContext\Application\Query\QueryHandlerInterface;
use Challenge\ShoppingCartContext\Domain\Repository\ShoppingCartRepository;
use Challenge\ShoppingCartContext\Application\Query\ListItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Response\ListItemShoppingCartResponse;
use Challenge\ShoppingCartContext\Application\Exception\CartShoppingNotFoundException;

final class ListItemShoppingCartHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ShoppingCartRepository $shoppingCartRepository,
    ) {}
    
    /**
     * Summary of handle
     * @param ListItemShoppingCartQuery $query
     */
    public function handle(ListItemShoppingCartQuery $query): AbstractResponse
    {

        $cart = $this->shoppingCartRepository->find($query->shoppingCart->id);
        
        if (null === $cart) {
            throw new CartShoppingNotFoundException("Shopping Cart not found");
        }
        
        return new ListItemShoppingCartResponse($cart);
    }
}
