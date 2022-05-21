<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HairColorType extends AbstractType
{
    public function getParent(): ?string
    {
        return ChoiceType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => [
                'Black' => 'black',
                'Blonde' => 'blonde',
                'Brown' => 'brown',
                'Red' => 'red',
            ],
        ]);
    }
}
