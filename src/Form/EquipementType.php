<?php

namespace App\Form;

use App\Entity\Equipement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name' , TextType::class,['label' => 'Nom de l\'equipement','attr' => ['class' => 'form-control input-md']])
            ->add('category', TextType::class,['label' => 'Category','attr' => ['class' => 'form-control input-md']])
            ->add('number', TextType::class,['label' => 'Numero de l\'equippement','attr' => ['class' => 'form-control input-md']])
            ->add('description', TextareaType::class,['label' => 'Description de l\'equippement','required'   => false,'empty_data' => '','attr' => ['class' => 'form-control input-md']])
            ->add('submit', SubmitType::class,  [
              'label' => 'Submit',
              'attr' => [
                  'class' => 'form-control btn btn btn-default',
                ],
             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipement::class,
        ]);
    }
}
