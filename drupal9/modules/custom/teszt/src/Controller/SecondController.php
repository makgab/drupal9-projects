<?php

namespace Drupal\teszt\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\example\ExampleInterface;
use Drupal\teszt\Service1;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for Teszt routes.
 */
class SecondController extends ControllerBase {

  /**
   * The teszt.service1 service.
   *
   * @var Service1
   */
  protected $tesztService1;

  /**
   * The controller constructor.
   *
   * @param \Drupal\example\ExampleInterface $teszt_service1
   *   The teszt.service1 service.
   */
  public function __construct(Service1 $teszt_service1) {
    $this->tesztService1 = $teszt_service1;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('teszt.service1')
    );
  }

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->tesztService1->get(),
      //'#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
