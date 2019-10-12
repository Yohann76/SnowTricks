<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Entity\Tricks;
use App\Entity\User;
use App\Entity\Comment;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;


class UserFixture extends BaseFixture
{
    public const USER1 = 'User1';

    private $passwordEncoder;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder; 
    }

    protected function loadData(ObjectManager $manager)
    {
        // user1
        $user1 = new User();
        $user1->setEmail('yohanndurand76@gmail.com')
            ->setFirstName('Yohann')
            ->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            'dev'
        ));
        $user1->setPicture('yohann.jpg');

        $this->addReference('User1',$user1);
        $manager->persist($user1);

        //  10 users
        $this->CreateMany(10,'main_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('yohanndurand%d@gmail.com',$i))
                 ->setFirstName($this->faker->firstName)
                 ->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'dev'
            ));

            return $user; 
        });

        // admin for exemple
        $this->CreateMany(1,'admin_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('yohanndurand76%d@gmail.com',$i))
                 ->setFirstName('Yohann');
           //    ->setRoles(['Role_ADMIN']);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'dev'
            ));

            return $user; 
        });

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
