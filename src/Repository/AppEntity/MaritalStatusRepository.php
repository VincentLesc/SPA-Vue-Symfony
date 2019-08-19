<?php

namespace App\Repository\AppEntity;

use App\Entity\AppEntity\MaritalStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MaritalStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaritalStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaritalStatus[]    findAll()
 * @method MaritalStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaritalStatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MaritalStatus::class);
    }

    // /**
    //  * @return MaritalStatus[] Returns an array of MaritalStatus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MaritalStatus
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
