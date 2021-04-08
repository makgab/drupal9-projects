<?php

namespace Drupal\teszt;

use Drupal\Core\StringTranslation\TranslationInterface;

/**
 * Service2 service.
 */
class Service2 {

  /**
   * The string translation service.
   *
   * @var \Drupal\Core\StringTranslation\TranslationInterface
   */
  protected $stringTranslation;

  /**
   * Constructs a Service2 object.
   *
   * @param \Drupal\Core\StringTranslation\TranslationInterface $string_translation
   *   The string translation service.
   */
  public function __construct(TranslationInterface $string_translation) {
    $this->stringTranslation = $string_translation;
  }

  /**
   * Method description.
   */
  public function get($name) {
    return $this->stringTranslation->translate('Hello Alter @name', [
      '@name' => $name,
    ]);
  }

}
