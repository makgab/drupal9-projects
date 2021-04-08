<?php

namespace Drupal\teszt\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a firstblock block.
 *
 * @Block(
 *   id = "teszt_firstblock",
 *   admin_label = @Translation("FirstBlock"),
 *   category = @Translation("Custom")
 * )
 */
class FirstblockBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#markup' => $this->t('It works!'),
    ];
    return $build;
  }

}
