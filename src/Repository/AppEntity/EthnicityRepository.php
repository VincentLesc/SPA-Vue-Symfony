<?php

namespace App\Repository\AppEntity;

use App\Entity\AppEntity\Ethnicity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ethnicity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ethnicity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ethnicity[]    findAll()
 * @method Ethnicity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EthnicityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ethnicity::class);
    }

    // /**
    //  * @return Ethnicity[] Returns an array of Ethnicity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ethnicity
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
