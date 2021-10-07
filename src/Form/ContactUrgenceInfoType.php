<?php

namespace App\Form;

use App\Entity\ContactUrgence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactUrgenceInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class, [
                'label'=>'Nom :',
                'required'=>true,

            ])
            ->add('prenom', TextType::class, [
                'label'=>'Prénom :',
                'required'=>true
            ])
            ->add('email', TextType::class, [
                'label'=>'E-mail :',
                'required'=>true
            ])
            ->add('telephone',TextType::class, [
                'label'=>'Téléphone :',
                'required' => true
            ])
            ->add('infosComplementaires', TextareaType::class, [
                'label' => 'Informations complémentaires :',
                'required'=> true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactUrgence::class,
            'csrf_protection' => true,

        ]);
    }
}
