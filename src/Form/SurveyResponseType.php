<?php

namespace App\Form;

use App\Entity\SurveyResponse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Zikula\Bundle\DynamicFormBundle\Form\Type\DynamicFieldsType;

class SurveyResponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('survey', DynamicFieldsType::class, [
                'specificationContainer' => $options['specificationContainer'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SurveyResponse::class,
        ]);
        $resolver->setRequired('specificationContainer');
    }
}
