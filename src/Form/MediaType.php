<?php	
namespace App\Form;

use App\DataFixtures\TricksFixture;
use App\Entity\Media;	
use App\Entity\Tricks;	
use Symfony\Bridge\Doctrine\Form\Type\EntityType;	
use Symfony\Component\Form\AbstractType;	
use Symfony\Component\Form\Extension\Core\Type\FileType;	
use Symfony\Component\Form\Extension\Core\Type\TextType;	
use Symfony\Component\Form\FormBuilderInterface;	
use Symfony\Component\OptionsResolver\OptionsResolver;	
use Symfony\Component\Form\FormTypeInterface;	
use Symfony\Component\Form\FormView;

class MediaType extends AbstractType	
{	
    public function buildForm(FormBuilderInterface $builder, array $options)	
    {	
        $builder	
            ->add('file' ,FileType::class, [	
                'label' => 'Fichier',	
                'required'   => true,	
            ])	
            ->add('text', TextType::class, [	
                'label' => 'Ajouter un texte',	
                'required'   => true,	
            ])	
            ;	
    }	
    public function configureOptions(OptionsResolver $resolver)	
    {	
        $resolver->setDefaults([	
            'data_class' => Media::class,	
        ]);	
    }	
}