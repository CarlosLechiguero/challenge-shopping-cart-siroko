<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Application\Response;

use Challenge\SharedContext\Application\Response\AbstractResponse;

final class DeleteItemShoppingCartResponse extends AbstractResponse
{
    public function __construct(){
        parent::__construct();
    }
    public function getData(): array
    {
        return [
            "message" => "Delete product succefully"
        ];
    }
}
