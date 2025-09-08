<?php

declare(strict_types=1);

namespace Challenge\Tests\Unit\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Repository;

use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Challenge\Test\Provider\DoctrineProvider;
use Challenge\ShoppingCartContext\Domain\Entity\OrderShoppingCart;
use Challenge\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Entity\OrderShoppingCartDoctrine;
use Challenge\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Repository\OrderShoppingCartDoctrineRepository;

final class OrderShoppingCartDoctrineRepositoryTest extends TestCase
{
    private readonly EntityManagerInterface $entityManager;
    private readonly OrderShoppingCartDoctrineRepository $repository;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->repository = new OrderShoppingCartDoctrineRepository($this->entityManager);

        parent::setUp();
    }

    /**
     * @dataProvider provideOrderShoppingCartDoctrineRepository
     */
    public function testOrderShoppingCartDoctrineRepository(OrderShoppingCart $orderShoppingCart): void
    {
        $this->entityManager
            ->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(OrderShoppingCartDoctrine::class));

        $this->entityManager
            ->expects($this->once())
            ->method('flush');


        $this->repository->checkout($orderShoppingCart);
    }

    public static function provideOrderShoppingCartDoctrineRepository(): array
    {
        return DoctrineProvider::provideOrderShoppingCartDoctrineRepository();
    }
}
