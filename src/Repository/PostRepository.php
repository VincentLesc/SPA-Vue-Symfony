<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * Return blog posts lazily
     *
     * @param int $offset First result
     * @param int $maxResult Max results
     *
     * @return array
     */
    public function findAllPostsLazily(int $offset, int $maxResult) :array
    {
        $qb = $this->createQueryBuilder('p')
            ->setFirstResult($offset)
            ->setMaxResults($maxResult)
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery();

        return $qb->execute();

    }
}
