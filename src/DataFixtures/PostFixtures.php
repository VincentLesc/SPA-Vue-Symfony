<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Provider\DateTime;
use Faker\Provider\Lorem;

class PostFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<10; $i++) {
            $post = new Post();
            $post->setTitle(Lorem::sentence())
                ->setContent(Lorem::paragraph(10))
                ->setCreatedAt(DateTime::dateTimeThisYear());
            $manager->persist($post);
        }
        $manager->flush();
    }
}
