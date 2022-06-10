<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Zikula\Bundle\DynamicFormBundle\Event\SupportedLocalesEvent;

class SupportedLocaleSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            SupportedLocalesEvent::class => 'addSupportedLocales'
        ];
    }

    public function addSupportedLocales(SupportedLocalesEvent $event): void
    {
        $supportedLocales = $event->getSupportedLocales(); // [0 => 'default']
        $supportedLocales = array_merge($supportedLocales, ['de', 'es', 'fr_FR', 'fr_BE']);
        $event->setSupportedLocales($supportedLocales);
    }
}