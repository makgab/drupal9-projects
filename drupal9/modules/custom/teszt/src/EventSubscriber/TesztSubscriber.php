<?php

namespace Drupal\teszt\EventSubscriber;

use Composer\EventDispatcher\Event;
use Drupal\Core\Entity\EntityTypeEvent;
use Drupal\Core\Entity\EntityTypeEvents;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\teszt\Event\TesztEvent;
use Drupal\teszt\Event\TesztEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Teszt event subscriber.
 */
class TesztSubscriber implements EventSubscriberInterface {

  /**
   * The messenger.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * Constructs event subscriber.
   *
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger.
   */
  public function __construct(MessengerInterface $messenger) {
    $this->messenger = $messenger;
  }

  public function onView(TesztEvent $event)
  {
    $this->messenger->addStatus('Hello View:' . $event->getValami());
  }
  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      TesztEvents::VIEW => ['onView'],
    ];
  }

}
