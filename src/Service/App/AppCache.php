<?php


namespace App\Service\App;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class AppCache
{
    private $cache;

    private $repository;

    public function __construct()
    {
        $this->cache = new FilesystemAdapter();
    }

    public function getAppCachedProperty(EntityRepository $repository, $objectId, $property)
    {
        $cachedData = $this->cache->getItem('app.'.$property.'.'.$objectId);
        if (!$cachedData->isHit()) {
            $cachedData->set($repository->find($objectId));
            $this->cache->save($cachedData);
        }
        return $cachedData->get();
    }

    public function getAppCachedGlobalEntity(EntityRepository $repository, $property)
    {
        $cachedData = $this->cache->getItem('app.'.$property);
        if (!$cachedData->isHit()) {
            $cachedData->set($repository->findAll());
            $this->cache->save($cachedData);
        }
        return $cachedData->get();
    }
}
