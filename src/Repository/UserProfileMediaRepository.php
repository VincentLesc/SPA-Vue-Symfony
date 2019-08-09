<?php

namespace App\Repository;

use App\Entity\UserProfileMedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserProfileMedia|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserProfileMedia|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserProfileMedia[]    findAll()
 * @method UserProfileMedia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserProfileMediaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserProfileMedia::class);
    }

    // /**
    //  * @return UserProfileMedia[] Returns an array of UserProfileMedia objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserProfileMedia
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
