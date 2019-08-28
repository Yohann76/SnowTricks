<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixture extends BaseFixture
{
    private $passwordEncoder;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder; 
    }

    protected function loadData(ObjectManager $manager)
    {
        // user
        $this->CreateMany(10,'main_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('yohanndurand%d@gmail.com',$i));
            $user->setFirstName($this->faker->firstName);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'dev'
            ));

            return $user; 
        });
        

        // admin
        $this->CreateMany(1,'admin_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('yohanndurand76%d@gmail.com',$i));
            $user->setFirstName('Yohann');
           // $user->setRoles(['Role_ADMIN']);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'dev'
            ));

            return $user; 
        });


        $manager->flush();
    }
}
