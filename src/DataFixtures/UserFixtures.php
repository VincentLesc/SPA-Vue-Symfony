<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Entity\UserProfileMedia;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Provider\DateTime;
use Faker\Provider\Lorem;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    private $repository;

    private $container;

    public function __construct(
        UserPasswordEncoderInterface $encoder,
        UserRepository $userRepository,
        ContainerInterface $container
    )
    {
        $this->encoder = $encoder;
        $this->repository = $userRepository;
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<100; $i++) {

            $user = new User();
            $user->setEmail('test'.$i.'@test.com')
                ->setPassword($this->encoder->encodePassword($user, 'toto'))
                ->setUsername('Username'.$i);
            $manager->persist($user);
            $profile = new UserProfile();
            $profile->setUser($user);
            $manager->persist($profile);
            $manager->flush();
            $users = $this->repository->findAll();
            $length = count($users);
            for($k =0; $k< random_int(1,10); $k++) {
                $userMedia = new UserProfileMedia();
                $fileUrl = 'https://picsum.photos/500/750';
                $file = $user->getUsername() . '_' . uniqid() . '.jpg';
                $fileName = $this->container->getParameter('user_profile_media_directory') . '/' . $file;

                copy($fileUrl, $fileName);
                $userMedia->setIsPublic(true)
                    ->setCreatedAt((DateTime::dateTimeBetween()))
                    ->setProfile($profile)
                    ->setFile($file);
                $profile->setMainPicture($userMedia);
                $manager->persist($profile);
                $manager->persist($userMedia);
                $manager->flush();
            }
            for ($j=0; $j<2; $j++) {
                $index = random_int(0,$length-1);
                $user = $users[$index];
                $post = new Post();
                $post->setTitle(Lorem::sentence(3))
                    ->setContent(Lorem::paragraph(5))
                    ->setCreatedAt(DateTime::dateTimeBetween())
                    ->setAuthor($user);
                $manager->persist($post);
            }
            $manager->flush();
        }

    }
}
