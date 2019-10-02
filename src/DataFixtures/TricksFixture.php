<?php

namespace App\DataFixtures;

use App\Entity\Tricks;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Media;

use App\DataFixtures\UserFixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TricksFixture extends BaseFixture implements DependentFixtureInterface
{


    public const TRICKS1 = 'tricks1';
    public const TRICKS2 = 'tricks2';
    public const TRICKS3 = 'tricks3';
    public const TRICKS4 = 'tricks4';
    public const TRICKS5 = 'tricks5';
    public const TRICKS6 = 'tricks6';
    public const TRICKS7 = 'tricks7';
    public const TRICKS8 = 'tricks8';
    public const TRICKS9 = 'tricks9';
    public const TRICKS10 = 'tricks10';


    protected function loadData(ObjectManager $manager)
    {
        $tricks1 = new Tricks();
        $tricks1->setName('mute')
            ->setContent('Contenu de la nouvelle figure')
            ->setDifficulty('1')
            ->setCategory('0')
            ->setDescription('Description de la figure numéro 1 ')
            ->setAuthor($this->getReference(UserFixture::USER1))
        ;
        $this->addReference('tricks1',$tricks1);
        $manager->persist($tricks1);



        $tricks2 = new Tricks();
        $tricks2->setName('sad')
            ->setContent('Hello Cette 2iem figure est en effet trés dificille...')
            ->setDifficulty('2')
            ->setCategory('1')
            ->setDescription('Description de la figure numéro 2')
            ->setAuthor($this->getReference(UserFixture::USER1))
        ;
        $this->addReference('tricks2',$tricks2);
        $manager->persist($tricks2);


        $tricks3 = new Tricks();
        $tricks3->setName('style week')
            ->setContent('Hello Cette 3iem figure est en effet trés dificille...')
            ->setDifficulty('2')
            ->setCategory('2')
            ->setDescription('Description de la figure numéro 3')

            ->setAuthor($this->getReference(UserFixture::USER1))
        ;
        $this->addReference('tricks3',$tricks3);
        $manager->persist($tricks3);


        $tricks4 = new Tricks();
        $tricks4->setName('indy')
            ->setContent('Hello Cette 4iem figure est en effet trés dificille...')
            ->setDifficulty('2')
            ->setCategory('2')
            ->setDescription('Description de la figure numéro 4')

            ->setAuthor($this->getReference(UserFixture::USER1))
        ;
        $this->addReference('tricks4',$tricks4);
        $manager->persist($tricks4);


        $tricks5 = new Tricks();
        $tricks5->setName('stalefish')
            ->setContent('Hello Cette 5iem figure est en effet trés dificille...')
            ->setDifficulty('2')
            ->setCategory('0')
            ->setDescription('Description de la figure numéro 5')

            ->setAuthor($this->getReference(UserFixture::USER1))
        ;
        $this->addReference('tricks5',$tricks5);
        $manager->persist($tricks5);


        $tricks6 = new Tricks();
        $tricks6->setName('tail grab')
            ->setContent('Hello Cette 6iem figure est en effet trés dificille...')
            ->setDifficulty('2')
            ->setCategory('1')
            ->setDescription('Description de la figure numéro 6')

            ->setAuthor($this->getReference(UserFixture::USER1))
        ;
        $this->addReference('tricks6',$tricks6);
        $manager->persist($tricks6);


        $tricks7 = new Tricks();
        $tricks7->setName('nose grab')
            ->setContent('Hello Cette 7iem figure est en effet trés dificille...')
            ->setDifficulty('2')
            ->setCategory('0')
            ->setDescription('Description de la figure numéro 7')

            ->setAuthor($this->getReference(UserFixture::USER1))
        ;
        $this->addReference('tricks7',$tricks7);
        $manager->persist($tricks7);


        $tricks8 = new Tricks();
        $tricks8->setName('japan air')
            ->setContent('Hello Cette 8iem figure est en effet trés dificille...')
            ->setDifficulty('1')
            ->setCategory('2')
            ->setDescription('Description de la figure numéro 8')

            ->setAuthor($this->getReference(UserFixture::USER1))
        ;
        $this->addReference('tricks8',$tricks8);
        $manager->persist($tricks8);

        $tricks9 = new Tricks();
        $tricks9->setName('seat belt')
            ->setContent('Hello Cette 9iem figure est en effet trés dificille...')
            ->setDifficulty('0')
            ->setCategory('1')
            ->setDescription('Description de la figure numéro 9')

            ->setAuthor($this->getReference(UserFixture::USER1))
        ;
        $this->addReference('tricks9',$tricks9);
        $manager->persist($tricks9);


        $tricks10 = new Tricks();
        $tricks10->setName('truck driver')
            ->setContent('Hello Cette 10iem figure est en effet trés dificille...')
            ->setDifficulty('1')
            ->setCategory('0')
            ->setDescription('Description de la figure numéro 10')

            ->setAuthor($this->getReference(UserFixture::USER1))
        ;
        $this->addReference('tricks10',$tricks10);
        $manager->persist($tricks10);



        $manager->flush();
    }

    public function getDependencies()
    {
        /**
         * This method must return an array of fixtures classes
         * on which the implementing class depends on
         *
         * @return array
         */
        return array(
            UserFixture::class,
        );
    }
}
