<?php

namespace Drupal\teszt\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\teszt\Event\TesztEvent;
use Drupal\teszt\Event\TesztEvents;
use Drupal\teszt\Service2;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Returns responses for Teszt routes.
 */
class ThirdController extends ControllerBase {

  /**
   * The teszt.service2 service.
   *
   * @var \Drupal\teszt\Service2
   */
  protected $tesztService2;

  protected $dispatcher;
  /**
   * The controller constructor.
   *
   * @param Drupal\teszt\Service2 $teszt_service2
   *   The teszt.service2 service.
   */
  public function __construct(Service2 $teszt_service2, EventDispatcherInterface $dispatcher) {
    $this->tesztService2 = $teszt_service2;
    $this->dispatcher = $dispatcher;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('teszt.service2'),
      $container->get('event_dispatcher')
    );
  }

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->tesztService2->get('Sanyi'),
    ];
    $event = new TesztEvent('valami szöveg Ezt küldöm');
    $this->dispatcher->dispatch(TesztEvents::VIEW, $event);
    return $build;
  }

}
