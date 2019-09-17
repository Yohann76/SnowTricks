<?php

namespace App\Form;

use App\Entity\Tricks;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TricksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom' ,
                'help' => 'Veuillez choisir un nom pour un Trick!'
            ])

            ->add('description')
            ->add('content', null, [
                'label' => 'Contenu'
            ])

            ->add('difficulty' , ChoiceType::class, [
                'label' => 'Difficulté',
                'choices' => $this->getChoices()
            ])

            ->add('media',CollectionType::class, [
                'entry_type' => MediaType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'required'   => false,
                'prototype' => true,
            ])
        ; 
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tricks::class,
        ]);
    }

    // Get number->tab
    private function getChoices()
    {
        $choices =  Tricks::Difficulty; 
        $output = []; 
        foreach($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output; 
    }
}
