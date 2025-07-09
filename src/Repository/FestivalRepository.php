<?php

namespace App\Repository;

use App\Entity\Festival;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Festival>
 */
class FestivalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Festival::class);
    }

    public function findTopFestivals(int $limit = 3): array
    {
        return $this->createQueryBuilder('f')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getFestivalsQueryBuilder(?string $searchTerm): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('f')
            ->leftJoin('f.location', 'l')
            ->orderBy('f.name', 'ASC');

        if ($searchTerm) {
            $queryBuilder
                ->andWhere('f.name LIKE :searchTerm OR l.name LIKE :searchTerm OR l.city LIKE :searchTerm')
                ->setParameter('searchTerm', '%' . $searchTerm . '%');
        }

        return $queryBuilder;
    }

    //    /**
    //     * @return FestivalFixtures[] Returns an array of FestivalFixtures objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?FestivalFixtures
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
