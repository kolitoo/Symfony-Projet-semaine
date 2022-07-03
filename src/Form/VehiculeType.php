<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')            
            ->add('couleur')
            ->add('taille', ChoiceType::class , [ // menu déroulant dans les form
                'choices'  => [
                    'XS' => 'XS',
                    'S' => 'S',
                    'M' => 'M',
                    'L' => 'L',
                    "XL" =>  "XL"
                    
                ]
            ])
            ->add('collection', ChoiceType::class , [
                'choices'  => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme'    
                ]
            ])
            ->add('photo' , FileType::class , ["mapped" => false , "required" => false])
            ->add('prix', MoneyType::class)
            ->add('stock')
            ->add("sauvegarder" , SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
