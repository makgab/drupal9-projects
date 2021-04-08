<?php

namespace Drupal\teszt\Controller;

use Drupal\Core\Block\BlockManager;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Returns responses for Teszt routes.
 */
class TesztController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    //BlockManager
    /** @var BlockManager */
    $block_manager = \Drupal::service('plugin.manager.block');
    /** @var Plugin */
    $block_plugin = $block_manager->createInstance('system_menu_block:main', []);
    return [
      'blockom' => $block_plugin->build(),
      'banner1' => [
        '#type' => 'banner',
        '#slogans' => ['Ezek a slogenek', 'Az élet szép', 'A világ megismerhető'],
      ],
      'banner2' => [
        '#type' => 'banner',
        '#slogans' => 'Ez itt egy string slogans, meg még ',
      ],
  ];
  }

}
