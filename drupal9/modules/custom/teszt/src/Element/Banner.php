<?php

namespace Drupal\teszt\Element;

use Drupal\Core\Render\Element\RenderElement;

/**
 * Provides a render element to display an entity.
 *
 * Properties:
 * - #slogans: The entity type.
 *
 * Usage Example:
 * @code
 * $build['node'] = [
 *   '#type' => 'banner',
 *   '#slogans' => 'This is a slogan',
 * ];
 * @endcode
 *
 * @RenderElement("banner")
 */
class Banner extends RenderElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    return [
      '#theme' => 'banner',
      '#attached' => [
        'library' => [
          'teszt/tesztlib',
        ]
      ]
    ];
  }
}
