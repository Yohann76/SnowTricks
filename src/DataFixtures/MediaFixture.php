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

    public function loadData(ObjectManager $manager)
    {
        $media1 = new Media();
        $media1->setPath('Media1Tricks1.jpg')
            ->setText('Image de flip')
            ->setTricks($this->getReference(TricksFixture::TRICKS1))
        ;
        $manager->persist($media1);

        $media2 = new Media();
        $media2->setPath('Media2Tricks2.jpg')
            ->setText('Image de figure rotative')
            ->setTricks($this->getReference(TricksFixture::TRICKS2))
        ;
        $manager->persist($media2);

        $media3 = new Media();
        $media3->setPath('Media3Tricks3.jpg')
            ->setText('Image de figure rotative')
            ->setTricks($this->getReference(TricksFixture::TRICKS3))
        ;
        $manager->persist($media3);


        $media4 = new Media();
        $media4->setPath('Media4Tricks4.jpg')
            ->setText('Image de figure rotative')
            ->setTricks($this->getReference(TricksFixture::TRICKS4))
        ;
        $manager->persist($media4);


        $media5 = new Media();
        $media5->setPath('Media5Tricks5.jpg')
            ->setText('Image de figure rotative')
            ->setTricks($this->getReference(TricksFixture::TRICKS5))
        ;
        $manager->persist($media5);


        $media6 = new Media();
        $media6->setPath('Media6Tricks6.jpg')
            ->setText('Image de flip')
            ->setTricks($this->getReference(TricksFixture::TRICKS6))
        ;
        $manager->persist($media6);

        $media7 = new Media();
        $media7->setPath('Media7Tricks7.jpg')
            ->setText('Image de figure rotative')
            ->setTricks($this->getReference(TricksFixture::TRICKS7))
        ;
        $manager->persist($media7);

        $media8 = new Media();
        $media8->setPath('Media8Tricks8.jpg')
            ->setText('Image de figure rotative')
            ->setTricks($this->getReference(TricksFixture::TRICKS8))
        ;
        $manager->persist($media8);


        $media9 = new Media();
        $media9->setPath('Media9Tricks9.jpg')
            ->setText('Image de figure rotative')
            ->setTricks($this->getReference(TricksFixture::TRICKS9))
        ;
        $manager->persist($media9);

        $media10 = new Media();
        $media10->setPath('Media10Tricks10.jpg')
            ->setText('Image de figure rotative')
            ->setTricks($this->getReference(TricksFixture::TRICKS10))
        ;
        $manager->persist($media10);

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




