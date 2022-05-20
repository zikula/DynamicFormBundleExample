<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Zikula\Bundle\DynamicFormPropertyBundle\Event\SupportedLocalesEvent;

class SupportedLocaleSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            SupportedLocalesEvent::class => 'addSupportedLocales'
        ];
    }

    public function addSupportedLocales(SupportedLocalesEvent $event)
    {
        $supportedLocales = $event->getSupportedLocales(); // [0 => 'default']
        $supportedLocales = array_merge($supportedLocales, ['de', 'es', 'fr_FR', 'fr_BE']);
        $event->setSupportedLocales($supportedLocales);
    }
}