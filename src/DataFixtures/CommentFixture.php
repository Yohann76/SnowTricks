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

    public function loadData(ObjectManager $manager)
    {
        $comment1 = new Comment();
        $comment1->setContent('Merci, Grace à votre site je me suis bien entrainer et réaliser de belle figure grace a vos conseil !! ');
        $comment1->setTricks($this->getReference(TricksFixture::TRICKS1));
        $comment1->setUser($this->getReference(UserFixture::USER1));
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2->setContent('houla trés belle figure, mais trés dur a réaliser, je conseil pour cela de bien sauter sur une rampe !! ');
        $comment2->setTricks($this->getReference(TricksFixture::TRICKS2));
        $comment2->setUser($this->getReference(UserFixture::USER1));
        $manager->persist($comment2);

        $comment3 = new Comment();
        $comment3->setContent('Cette figure est ma préféré ! ');
        $comment3->setTricks($this->getReference(TricksFixture::TRICKS3));
        $comment3->setUser($this->getReference(UserFixture::USER1));
        $manager->persist($comment3);

        $comment4 = new Comment();
        $comment4->setContent('Cette figure est ma préféré , je vais essayer de la faire ! ');
        $comment4->setTricks($this->getReference(TricksFixture::TRICKS4));
        $comment4->setUser($this->getReference(UserFixture::USER1));
        $manager->persist($comment4);

        $comment5 = new Comment();
        $comment5->setContent('Cette figure est ma préféré , je vais essayer de la faire ! ');
        $comment5->setTricks($this->getReference(TricksFixture::TRICKS5));
        $comment5->setUser($this->getReference(UserFixture::USER1));
        $manager->persist($comment5);


        $comment6 = new Comment();
        $comment6->setContent('Cette figure est ma préféré , je vais essayer de la faire ! ');
        $comment6->setTricks($this->getReference(TricksFixture::TRICKS6));
        $comment6->setUser($this->getReference(UserFixture::USER1));
        $manager->persist($comment6);

        $comment7 = new Comment();
        $comment7->setContent('Cette figure est ma préféré , je vais essayer de la faire ! ');
        $comment7->setTricks($this->getReference(TricksFixture::TRICKS7));
        $comment7->setUser($this->getReference(UserFixture::USER1));
        $manager->persist($comment7);

        $comment8 = new Comment();
        $comment8->setContent('Cette figure est ma préféré , je vais essayer de la faire ! ');
        $comment8->setTricks($this->getReference(TricksFixture::TRICKS8));
        $comment8->setUser($this->getReference(UserFixture::USER1));
        $manager->persist($comment8);

        $comment9 = new Comment();
        $comment9->setContent('Cette figure est ma préféré , je vais essayer de la faire ! ');
        $comment9->setTricks($this->getReference(TricksFixture::TRICKS9));
        $comment9->setUser($this->getReference(UserFixture::USER1));
        $manager->persist($comment9);

        $comment10 = new Comment();
        $comment10->setContent('Cette figure est ma préféré , je vais essayer de la faire ! ');
        $comment10->setTricks($this->getReference(TricksFixture::TRICKS10));
        $comment10->setUser($this->getReference(UserFixture::USER1));
        $manager->persist($comment10);

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
