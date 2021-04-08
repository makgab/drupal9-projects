<?php

namespace Drupal\teszt\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Returns responses for Teszt routes.
 */
class ParameterController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build(Request $request,  $parameter) {
    $valami = $request->get('valami');
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('Parameter: @parameter, Valami: @valami', [
        '@parameter' => $parameter,
        '@valami' => $valami,
      ]),
    ];

    return $build;
  }

}
