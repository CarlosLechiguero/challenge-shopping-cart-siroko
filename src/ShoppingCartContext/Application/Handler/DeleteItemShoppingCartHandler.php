<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Handler;

use Challenge\SharedContext\Application\Response\AbstractResponse;
use Challenge\SharedContext\Application\Query\QueryHandlerInterface;
use Challenge\ShoppingCartContext\Domain\Repository\ShoppingCartRepository;
use Challenge\ShoppingCartContext\Domain\Service\RemoveProductFromCartService;
use Challenge\ShoppingCartContext\Application\Query\DeleteItemShoppingCartQuery;
use Challenge\ShoppingCartContext\Application\Response\DeleteItemShoppingCartResponse;
use Challenge\ShoppingCartContext\Application\Exception\CartShoppingNotFoundException;

final class DeleteItemShoppingCartHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ShoppingCartRepository $shoppingCartRepository,
        private readonly RemoveProductFromCartService $removeProductFromCartService,
    ) {}
    
    /**
     * Summary of handle
     * @param DeleteItemShoppingCartQuery $query
     */
    public function handle(DeleteItemShoppingCartQuery $query): AbstractResponse
    {
        $cart = $this->shoppingCartRepository->find($query->shoppingCart->id);

        if (null === $cart) {
            throw new CartShoppingNotFoundException("Shopping Cart not found");
        }

        foreach ($query->shoppingCart->items() as $item) {
            ($this->removeProductFromCartService)($cart, $item->productId);
        }

        $this->shoppingCartRepository->deleteCartItem($query->shoppingCart);
        return new DeleteItemShoppingCartResponse();
    }
}
