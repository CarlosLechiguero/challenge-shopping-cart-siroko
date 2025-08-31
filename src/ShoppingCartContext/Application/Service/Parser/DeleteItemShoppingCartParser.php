<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Service\Parser;

use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Application\DTO\DeleteItemDto;
use Challenge\ShoppingCartContext\Domain\ValueObject\DeleteProductValue;

class DeleteItemShoppingCartParser
{
    public function __invoke(DeleteItemDto $deleteItemDto): DeleteProductValue
    {

        $deleteItem = new DeleteProductValue(
        new CartId($deleteItemDto->cartId),
        new ProductId($deleteItemDto->productId),
        );

        return $deleteItem;
    }
}
