<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Challenge\ShoppingCartContext\Domain\Entity\OrderShoppingCart;
use Challenge\ShoppingCartContext\Domain\Repository\OrderShoppingCartRepository;
use Challenge\ShoppingCartContext\Infrastructure\Mapper\OrderShoppingCartMapper;
use Challenge\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Entity\OrderShoppingCartDoctrine;

final class OrderShoppingCartDoctrineRepository implements OrderShoppingCartRepository
{
    private  EntityRepository $repository;

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
        $this->repository = $this->entityManager->getRepository(OrderShoppingCartDoctrine::class);
    }

    public function checkout(OrderShoppingCart $orderShoppingCart): void
    {
        $orderDoctrine = OrderShoppingCartMapper::mapToDoctrine($orderShoppingCart);

        $this->entityManager->persist($orderDoctrine);
        $this->entityManager->flush();
    }
}