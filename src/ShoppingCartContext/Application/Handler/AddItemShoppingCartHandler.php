<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Handler;

use Challenge\SharedContext\Application\Query\QueryHandlerInterface;
use Challenge\SharedContext\Application\Response\AbstractResponse;
use Challenge\ShoppingCartContext\Application\Query\AddItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Response\AddItemShoppingCartResponse;
use Challenge\ShoppingCartContext\Domain\Repository\ShoppingCartRepository;
use Challenge\ShoppingCartContext\Domain\Service\AddProductToCartService;

final class AddItemShoppingCartHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ShoppingCartRepository $shoppingCartRepository,
        private readonly AddProductToCartService $addProductToCartService,
    ) {}
    
    /**
     * Summary of handle
     * @param AddItemShoppingCartQuery $query
     */
    public function handle(AddItemShoppingCartQuery $query): AbstractResponse
    {
        $cart = $this->shoppingCartRepository->find($query->shoppingCart->id);

        if (null !== $cart) {
            foreach ($query->shoppingCart->items() as $item) {
                ($this->addProductToCartService)($cart, $item->productId, $item->getQuantity());
            }

            $this->shoppingCartRepository->save($cart);
            return new AddItemShoppingCartResponse($cart);
        }
        
        $cart = $query->shoppingCart;
        $this->shoppingCartRepository->save($cart, true);
        return new AddItemShoppingCartResponse($cart);
    }
}
