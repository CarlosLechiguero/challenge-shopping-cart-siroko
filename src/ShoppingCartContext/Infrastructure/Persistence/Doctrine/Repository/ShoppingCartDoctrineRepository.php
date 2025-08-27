<?php

declare(strict_types=1);

namespace Challenge\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Challenge\ShoppingCartContext\Domain\Entity\CartItem;
use Challenge\ShoppingCartContext\Domain\ValueObject\CartId;
use Challenge\ShoppingCartContext\Domain\Entity\ShoppingCart;
use Challenge\ShoppingCartContext\Domain\ValueObject\ProductId;
use Challenge\ShoppingCartContext\Domain\ValueObject\QuantityValue;
use Challenge\ShoppingCartContext\Domain\Repository\ShoppingCartRepository;
use Challenge\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Entity\CartItemDoctrine;
use Challenge\ShoppingCartContext\Infrastructure\Persistence\Doctrine\Entity\ShoppingCartDoctrine;

final class ShoppingCartDoctrineRepository implements ShoppingCartRepository
{
    private  EntityRepository $repository;

    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
        $this->repository = $this->entityManager->getRepository(ShoppingCartDoctrine::class);
    }

    public function save(ShoppingCart $cart, bool $persist = false): void
    {
        $doctrineCart = $this->mapDomainToDoctrine($cart);

        if ($persist) {
             $this->entityManager->persist($doctrineCart);
        }

        $this->entityManager->flush();
    }

    public function find(CartId $cartId): ?ShoppingCart
    {
        $doctrineCart = $this->repository->findOneBy([
            "cartId"=> $cartId->value(),
        ]);

        if (!$doctrineCart) {
            return null;
        }

        return $this->mapDoctrineToDomain($doctrineCart);
    }

    public function deleteCartItem(ShoppingCart $cart): void
    {
        $doctrineCart = $this->repository->findOneBy([
            'cartId' => $cart->id->value(),
        ]);
        
        $targetProductId = $cart->items()[0]->productId->value();

        $cartItemDoctrine = $doctrineCart->items()->filter(
            fn(CartItemDoctrine $item) => $item->productId === $targetProductId
        )->first();

        $this->entityManager->createQueryBuilder()
            ->delete(CartItemDoctrine::class, 'c')
            ->where('c.id = :id')
            ->setParameter('id', $cartItemDoctrine->id)
            ->getQuery()
            ->execute();
    }



    private function mapDomainToDoctrine(ShoppingCart $cart): ShoppingCartDoctrine
    {
        $doctrineCart = $this->repository->findOneBy([
            'cartId' => $cart->id->value(),
        ]) ?? new ShoppingCartDoctrine($cart->id->value());


        $existingItems = [];
        foreach ($doctrineCart->items() as $doctrineItem) {
            $existingItems[$doctrineItem->productId] = $doctrineItem;
        }

        foreach ($cart->items() as $domainItem) {
            $productId = $domainItem->productId->value();

            if (isset($existingItems[$productId])) {
                $existingItems[$productId]->setQuantity($domainItem->getQuantity()->getQuantity());
                unset($existingItems[$productId]);
            } else {
                $doctrineCart->addItem(
                    new CartItemDoctrine(
                        $productId,
                        $domainItem->getQuantity()->getQuantity(),
                        $doctrineCart
                    )
                );
            }
        }

        foreach ($existingItems as $doctrineItem) {
            $doctrineCart->items()->removeElement($doctrineItem);
        }

        return $doctrineCart;
    }




    private function mapDoctrineToDomain(ShoppingCartDoctrine $doctrineCart): ShoppingCart
    {
        $cart = new ShoppingCart(new CartId($doctrineCart->cartId));

        foreach ($doctrineCart->items() as $item) {
            $cart->addItemEntity(
                new CartItem(
                    new ProductId($item->productId),
                    new QuantityValue($item->getQuantity())
                )
            );
        }

        return $cart;
    }
}
