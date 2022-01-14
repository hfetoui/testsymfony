<?php

namespace App\Form;

use App\Entity\Equipement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipementType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('name' , TextType::class,['label' => 'Nom de l\'equipement','attr' => ['class' => 'form-control input-md']])
                ->add('category', ChoiceType::class, [
                'choices'  => $this->getCategories()
                ,'label' => 'Categorie','attr' => ['class' => 'form-control input-md']
            ])
            ->add('number', TextType::class,['label' => 'Reference','attr' => ['class' => 'form-control input-md']])
            ->add('description', TextareaType::class,['label' => 'Description','required'   => false,'empty_data' => '','attr' => ['class' => 'form-control input-md']])
            ->add('submit', SubmitType::class,  [
              'label' => 'Envoyer',
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

    private function getCategories(){
        $retours=[];
        foreach (Equipement::$categories as $value) {
           $retours[$value]=$value;

        }
        return $retours;
    }
}
