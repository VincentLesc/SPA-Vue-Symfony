<?php

namespace App\DataFixtures;

use App\Entity\AppEntity\CommunityGroup;
use App\Entity\AppEntity\MaritalStatus;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Entity\UserProfileMedia;
use App\Repository\AppEntity\CommunityGroupRepository;
use App\Repository\AppEntity\MaritalStatusRepository;
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

    private $maritalStatusRepository;

    private $groupsRepository;

    public function __construct(
        UserPasswordEncoderInterface $encoder,
        UserRepository $userRepository,
        ContainerInterface $container,
        MaritalStatusRepository $maritalStatusRepository,
        CommunityGroupRepository $groupsRepository
    )
    {
        $this->encoder = $encoder;
        $this->repository = $userRepository;
        $this->container = $container;
        $this->maritalStatusRepository = $maritalStatusRepository;
        $this->groupsRepository = $groupsRepository;
    }

    public function load(ObjectManager $manager)
    {
        $status = ['marié', 'célibataire', 'union libre', 'pacsé', 'compliqué'];
        foreach ($status as $title) {
            $maritalStatus = new MaritalStatus();
            $maritalStatus->setTitle($title);
            $manager->persist($maritalStatus);
            $manager->flush();
        }

        $groups = ['bear', 'teen', 'exhib', 'sm', 'fist'];
        foreach ($groups as $title) {
            $group = new CommunityGroup();
            $group->setTitle($title);
            $manager->persist($group);
            $manager->flush();
        }

        for ($i=0; $i<100; $i++) {

            $user = new User();
            $user->setEmail('test'.$i.'@test.com')
                ->setPassword($this->encoder->encodePassword($user, 'toto'))
                ->setUsername('Username'.$i);
            $manager->persist($user);
            $profile = new UserProfile();
            $nbParagraph = random_int(0,20);
            $profile->setUser($user)
                ->setTitle(Lorem::text(16))
                ->setDescription(Lorem::paragraph($nbParagraph))
                ->setAge(random_int(18,99));
            $maritalStatus = shuffle($status);
            $groupStatus = shuffle($groups);
            $profile->setMaritalStatus($this->maritalStatusRepository->findOneBy(['title'=>$maritalStatus[0]]));
            $profile->addGroup($this->groupsRepository->findOneBy(['title'=>'bear']));
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
