<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\Survey;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Zikula\Bundle\DynamicFormPropertyBundle\Form\Type\DynamicFieldType;

class SurveyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('questions', CollectionType::class, [
                'entry_type' => DynamicFieldType::class,
                'entry_options' => [
                    'data_class' => Question::class
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true, // required for javascript to work
                'by_reference' => false // required to force use of add/remove methods in Survey
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Survey::class,
        ]);
    }
}
