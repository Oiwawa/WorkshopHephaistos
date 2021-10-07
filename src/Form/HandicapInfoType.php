<?php

namespace App\Form;

use App\Entity\CategorieHandicap;
use App\Entity\Handicap;
use App\Entity\TypeHandicap;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HandicapInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tx_incapacite_perm', IntegerType::class, [
                'label' => 'Taux d\'incapacité permanente en %',
                'required'=> false,
                'attr' => array('min' => '1', 'max' => '100')
            ])
            ->add('num_aggir', IntegerType::class, [
                'label'=> 'Numéro Gir (Entre 1 et 6) :',
                'required'=> false,
                'attr' => array('min' => '1', 'max' => '6')
            ])
            ->add('categorieCPAM', IntegerType::class, [
                'label'=> 'Numéro de catégorie CPAM (Entre 1 & 3) :',
                'required'=> false,
                'attr' => array('min' => '1', 'max' => '3')
            ])
            ->add('infosComplementaires', TextareaType::class, [
                'label' => 'Informations complémentaires :',
                'required'=> false
            ])
            ->add('categorieHandicap', EntityType::class, [
                'label' => 'Catégorie d\'handicap : *',
                'class'=> CategorieHandicap::class,
                'required'=>true,
                'choice_label' => 'nom',
                'expanded'=>false,
                'multiple'=>false
            ])
            ->add('typeHandicap', EntityType::class, [
                'label' => 'Catégorie d\'handicap : *',
                'class'=> TypeHandicap::class,
                'required'=>true,
                'choice_label' => 'nom',
                'expanded'=>false,
                'multiple'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Handicap::class,
            'csrf_protection' => true,

        ]);
    }
}
