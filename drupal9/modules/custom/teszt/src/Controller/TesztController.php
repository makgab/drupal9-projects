<?php

namespace Drupal\teszt\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Teszt routes.
 */
class TesztController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
