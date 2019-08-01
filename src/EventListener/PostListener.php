<?php


namespace App\EventListener;


use App\Entity\Post;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;

class PostListener
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if (!$entity instanceof Post) {
            return;
        }
        $entity->setAuthor($this->security->getUser());
    }
}