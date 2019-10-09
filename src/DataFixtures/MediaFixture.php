<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\TricksFixture;
use App\Entity\Media;
use App\Entity\Tricks;
use App\Entity\User;
use App\Entity\Comment;

class MediaFixture extends BaseFixture implements DependentFixtureInterface
{

    private static $path = [
        'Media1Tricks1.jpg',
        'Media2Tricks2.jpg',
        'Media3Tricks3.jpg',
        'Media4Tricks4.jpg',
        'Media5Tricks5.jpg',
        'Media6Tricks6.jpg',
        'Media7Tricks7.jpg',
        'Media8Tricks8.jpg',
        'Media9Tricks9.jpg',
        'Media10Tricks10.jpg',
    ];

    public function loadData(ObjectManager $manager)
    {
        for ($i = 1; $i <= 27; $i++) {
            $media1 = new Media();

            $media1->setPath($this->faker->randomElement(self::$path))
                ->setText('Hello World'.$i)
                ->setTricks($this->getReference('trick'.$i))
                ->setThumbnail(True)
            ;
            $manager->persist($media1);
        }
        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [TricksFixture::class];
    }
}




