<?php

namespace App\Repository\AppEntity;

use App\Entity\AppEntity\SexualPosition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SexualPosition|null find($id, $lockMode = null, $lockVersion = null)
 * @method SexualPosition|null findOneBy(array $criteria, array $orderBy = null)
 * @method SexualPosition[]    findAll()
 * @method SexualPosition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SexualPositionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SexualPosition::class);
    }

    // /**
    //  * @return SexualPosition[] Returns an array of SexualPosition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SexualPosition
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}