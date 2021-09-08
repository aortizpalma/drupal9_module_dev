<?php

namespace Drupal\headers_manager\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Response subscriber to remove these X-generator header tags
 */
class HeadersManagerResponseSubscriber implements EventSubscriberInterface {

    /**
     * Remove extra X-generator header on successful response
     * 
     * @param \Symfony\Component\HttpKernel\Event\FilterResponseEvent $event
     * the event to process
     */
    public function HeadersManagerOptions(FilterResponseEvent $event) {
        $response = $event->getResponse();
        $response->headers->remove('X-Generator');
        #$response->header->add('Power by X');
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents() {
        $events[KernelEvents::RESPONSE][] = ['HeadersManagerOptions', -10];
        return $events;
    }

}