<?php

namespace App\Form;

use App\Entity\SurveyResponse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Zikula\Bundle\DynamicFormBundle\Form\Type\InlineFormDefinitionType;

class SurveyResponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('survey', InlineFormDefinitionType::class, [
                'dynamicFieldsContainer' => $options['dynamicFieldsContainer'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SurveyResponse::class,
        ]);
        $resolver->setRequired('dynamicFieldsContainer');
    }
}
