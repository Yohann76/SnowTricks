<?php	
namespace App\Form;

use App\Entity\User;	
use Symfony\Component\Form\AbstractType;	
use Symfony\Component\Form\FormBuilderInterface;	
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegistrationType extends AbstractType	
{	
    public function buildForm(FormBuilderInterface $builder, array $options)	
    {	
        $builder	
            ->add('email')	
            ->add('firstName', null, [	
                'label' => 'Nom'	
            ])	
            ->add('password', null, [	
                'label' => 'Mots de passe'	
            ])	
        ;	
    }	
    public function configureOptions(OptionsResolver $resolver)	
    {	
        $resolver->setDefaults([	
            'data_class' => User::class,	
        ]);	
    }	
}