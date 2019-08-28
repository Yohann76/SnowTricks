<?php

namespace App\DataFixtures;

use App\Entity\Tricks;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Media;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TricksFixture extends BaseFixture
{
    private $passwordEncoder;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder; 
    }

    protected function loadData(ObjectManager $manager)
    {

            $tricks = new Tricks();
            $tricks->setName('Nouvelle figure')
                ->setContent('Contenu de la nouvelle figure')
                ->setDifficulty('1')
                ->setAuthor('Yohann')
                ->setDescription('Description de la figure')
            ;
            $manager->persist($tricks);


            $media = new Media();
            $media->setTricks($tricks);
            $media->setPath('images/1.jpg');
          //  $media->setType('Picture');
            $media->setText('Image de flip');
            $manager->persist($media);

        $media1 = new Media();
        $media1->setTricks($tricks);
        $media1->setPath('images/2.jpg');
      //  $media1->setType('Picture');
        $media1->setText('Image de flip');
        $manager->persist($media1);



            $user = new User();
            $user->setEmail('azerty@gmail.com');
            $user->setFirstName('azerty');
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'dev'
            )); 
            $manager->persist($user);

            $user1 = new User();
            $user1->setEmail('querty@gmail.com');
            $user1->setFirstName('querty');
            $user1->setPassword($this->passwordEncoder->encodePassword(
                $user1,
                'dev'
            )); 
            $manager->persist($user1);





            $comment1 = new Comment();
            $comment1->setContent('trés dur! ');
            $comment1->setTricks($tricks);
            $comment1->setUser($user);
            $manager->persist($comment1);

            $comment2 = new Comment();
            $comment2->setContent('houla! ');
            $comment2->setTricks($tricks);
            $comment2->setUser($user1);
            $manager->persist($comment2);
                
                
           
       
    
        
        
        
        $manager->flush();
    }
}
