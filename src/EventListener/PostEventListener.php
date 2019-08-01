<?php


namespace App\EventListener;


use App\Entity\Post;
use App\Entity\User;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;

class PostEventListener
{
    /** @var User $user */
    private $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        if ('cli' != php_sapi_name()) {
            if ($args->getObject() instanceof Post) {
                $args->getObject()->setAuthor($this->user)
                    ->setCreatedAt();
            }
        }
    }
}
