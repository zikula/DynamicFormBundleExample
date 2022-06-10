<?php

namespace App\EventSubscriber;

use App\Form\HairColorType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Zikula\Bundle\DynamicFormBundle\Event\FormTypeChoiceEvent;

class CustomFormTypeSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            FormTypeChoiceEvent::class => ['addFormTypes'],
        ];
    }

    public function addFormTypes(FormTypeChoiceEvent $event)
    {
        $event->addChoice('Other fields', 'Hair Color', HairColorType::class);
        $event->removeChoice('Choice fields', 'Currency');
    }
}