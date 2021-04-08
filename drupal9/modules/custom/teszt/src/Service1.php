<?php

namespace Drupal\teszt;

use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Service1 service.
 */
class Service1 {

  use StringTranslationTrait;
  /**
   * Method description.
   */
  public function get() {
    return $this->t('Hello @name', ['@name' => 'Pista']);
  }

}
