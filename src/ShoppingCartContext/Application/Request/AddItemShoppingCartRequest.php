<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Request;

use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\Service\AddProductToCartService;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;

final class AddItemShoppingCartRequest
{
    public function __construct(
        private readonly AddProductToCartService $addProductToCartService
    ) {}

    public function __invoke(string $request): ShoppingCart
    {

        $request = json_decode($request, true);

        $shoppingCart = new ShoppingCart(
            new CartId($request["cartId"])
        );

        ($this->addProductToCartService)(
            $shoppingCart,
            new ProductId($request["productId"]),
            new QuantityValue($request["quantity"]),
        );

        return $shoppingCart;
    }
}
