<?php

namespace App\Repository;

use App\Entity\IssuedTicket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IssuedTicket>
 */
class IssuedTicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IssuedTicket::class);
    }

    public function findByTransactionId($value): array
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.booking', 'b')
            ->andWhere('b.transactionId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
}
