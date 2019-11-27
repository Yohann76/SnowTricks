<?php	
namespace App\Form;

use App\DataFixtures\TricksFixture;
use App\Entity\Media;	
use App\Entity\Tricks;	
use Symfony\Bridge\Doctrine\Form\Type\EntityType;	
use Symfony\Component\Form\AbstractType;	
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;	
use Symfony\Component\OptionsResolver\OptionsResolver;	
use Symfony\Component\Form\FormTypeInterface;	
use Symfony\Component\Form\FormView;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;

class MediaType extends AbstractType	
{	
    public function buildForm(FormBuilderInterface $builder, array $options)	
    {	
        $builder	
            ->add('file' ,FileType::class, [	
                'label' => 'Fichier ( png ou jpeg ) ',
                'required'   => true,
                'attr' => array(
                    'accept' => "image/jpeg, image/png"
                ),
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => ['image/png', 'image/jpeg',],
                        'mimeTypesMessage' => 'Please upload a valid png/jpeg document',
                    ])
                ],
            ])
            ->add('text', TextType::class, [	
                'label' => 'Ajouter un texte',	
                'required'   => true,	
            ])
            ->add('thumbnail', RadioType::class, [
                'label' => 'Définir comme image à la une ?',
                'required'   => false,
                'by_reference' => false,
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