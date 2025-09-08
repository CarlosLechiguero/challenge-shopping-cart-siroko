<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Handler;

use Challenge\ShoppingCartContext\Domain\ValueObject\OrderId;
use Challenge\SharedContext\Application\Response\AbstractResponse;
use Challenge\ShoppingCartContext\Domain\Entity\OrderShoppingCart;
use Challenge\SharedContext\Application\Query\QueryHandlerInterface;
use Challenge\ShoppingCartContext\Domain\Repository\ShoppingCartRepository;
use Challenge\ShoppingCartContext\Application\Query\CheckoutShoppingCartQuery;
use Challenge\ShoppingCartContext\Domain\Repository\OrderShoppingCartRepository;
use Challenge\ShoppingCartContext\Application\Response\CheckoutShoppingCartResponse;
use Challenge\ShoppingCartContext\Domain\Service\CalculateShoppingCartAmountService;
use Challenge\ShoppingCartContext\Application\Exception\CartShoppingNotFoundException;


final class CheckoutShoppingCartHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ShoppingCartRepository             $shoppingCartRepository,
        private readonly OrderShoppingCartRepository        $orderShoppingCartRepository,
        private readonly CalculateShoppingCartAmountService $calculateShoppingCartAmountService,
    ) {}
    
    /**
     * Summary of handle
     * @param CheckoutShoppingCartQuery $query
     */
    public function handle(CheckoutShoppingCartQuery $query): AbstractResponse
    {
        $cart = $this->shoppingCartRepository->find($query->cartId);   

        if (null === $cart) {
            throw new CartShoppingNotFoundException("Shopping Cart not found");
        }

        $totalAmount = ($this->calculateShoppingCartAmountService)($cart);
        $orderShoppingCart = new OrderShoppingCart(
            OrderId::generate(),
            $cart,
            $totalAmount,
        );

        $this->orderShoppingCartRepository->checkout($orderShoppingCart);
        $this->shoppingCartRepository->deleteCart($cart);
        return new CheckoutShoppingCartResponse($orderShoppingCart);
    }
}
