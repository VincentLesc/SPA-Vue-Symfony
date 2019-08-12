<?php


namespace App\EventListener;


use App\Entity\User;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

class SecurityEventListener
{

    /** @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    /**
     * HashPasswordListener constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        dump('event');
            if ($args->getObject() instanceof User) {
                $this->encodePassword($args->getObject());
            }
    }

    /**
     * @param User $entity
     * @return void
     */
    private function encodePassword(User $entity): void
    {
        if (\is_null($entity->getPlainPassword())) {
            return;
        }

        $encoded = $this->passwordEncoder->encodePassword(
            $entity,
            $entity->getPlainPassword()
        );

        $entity->setPassword($encoded);
        dump($entity);

    }
}
