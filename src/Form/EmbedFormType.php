<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Faker\Provider\File;
use Symfony\Component\Form\FormView;
use Symfony\Component\Validator\Constraints\Length;

class EmbedFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Embed', TextType::class, [
                'label' => 'Veuillez insérer un lien de type "iframe" ',
                'required'   => false,
                'constraints' => [
                    new Length(['min' => 20]),
                ],
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
