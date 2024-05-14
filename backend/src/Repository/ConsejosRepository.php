<?php

namespace App\Repository;

use App\Entity\Consejos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Consejos>
 *
 * @method Consejos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consejos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consejos[]    findAll()
 * @method Consejos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsejosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Consejos::class);
    }

//    /**
//     * @return Consejos[] Returns an array of Consejos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Consejos
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
