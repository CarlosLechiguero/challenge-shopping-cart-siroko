<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'order_shopping_cart')]
final readonly class OrderShoppingCartDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    public int $id;

    public function __construct(
        #[ORM\Column(type: Types::STRING, length: 36)]
        public string $orderId,

        #[ORM\Column(type: Types::JSON)]
        public array $cart,

        #[ORM\Column(type: Types::FLOAT)]
        public float $amount,

        #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
        public \DateTimeImmutable $createdAt,
    ) {
    }
}
