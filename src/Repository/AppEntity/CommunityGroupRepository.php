<?php

namespace App\Repository\AppEntity;

use App\Entity\AppEntity\CommunityGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CommunityGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommunityGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommunityGroup[]    findAll()
 * @method CommunityGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommunityGroupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CommunityGroup::class);
    }

    // /**
    //  * @return CommunityGroup[] Returns an array of CommunityGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommunityGroup
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
