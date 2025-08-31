<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Handler;

use Challenge\SharedContext\Application\Response\AbstractResponse;
use Challenge\SharedContext\Application\Query\QueryHandlerInterface;
use Challenge\ShoppingCartContext\Domain\Repository\ShoppingCartRepository;
use Challenge\ShoppingCartContext\Domain\Service\UpdateProductToCartService;
use Challenge\ShoppingCartContext\Application\Query\UpdateItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Exception\CartShoppingNotFoundException;
use Challenge\ShoppingCartContext\Application\Response\UpdateItemShoppingCartResponse;

final class UpdateItemShoppingCartHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ShoppingCartRepository $shoppingCartRepository,
        private readonly UpdateProductToCartService $updateProductFromCartService,
    ) {}
    
    /**
     * Summary of handle
     * @param UpdateItemShoppingCartQuery $query
     */
    public function handle(UpdateItemShoppingCartQuery $query): AbstractResponse
    {
        $cart = $this->shoppingCartRepository->find($query->shoppingCart->id);

        if (null === $cart) {
            throw new CartShoppingNotFoundException("Shopping Cart not found");
        }

        foreach ($query->shoppingCart->items() as $item) {
            ($this->updateProductFromCartService)($cart, $item->productId, $item->getQuantity());
        }

        $this->shoppingCartRepository->save($cart);
        return new UpdateItemShoppingCartResponse($cart);
    }
}