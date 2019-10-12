<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Media;
use App\Entity\Tricks;
use App\Entity\User;
use App\Entity\Comment;

class CommentFixture extends BaseFixture implements DependentFixtureInterface
{
    public const ADMIN_USER_REFERENCE = 'user5';
    public const TRICK_REFERENCE = 'trick';

    private static $comment = [
        'Funny' ,
        'Great Tricks',
        'Go to prepare this tricks in holliday !!',
        'good but its not easy',
        'Excellent, more information please',
        'Picture is attractive <3',
        'magnifico !! ',
        'bad tricks..',
        'cool ',
        'nice !! i try this after ',
        'i love a title of this trick ',
    ];

    public function loadData(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $comment = new Comment();
            $comment->setContent($this->faker->randomElement(self::$comment))
                ->setTricks($this->getReference('trick'.$i))
                ->setUser($this->getReference('User1'))
            ;
            $manager->persist($comment);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixture::class,
            TricksFixture::class
        );
    }
}
