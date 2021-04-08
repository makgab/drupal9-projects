<?php

namespace Drupal\teszt\Plugin\Filter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

/**
 * Provides a 'Gyumi' filter.
 *
 * @Filter(
 *   id = "teszt_gyumi",
 *   title = @Translation("Gyumi"),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 *   settings = {
 *     "example" = "foo",
 *   },
 *   weight = -10
 * )
 */
class Gyumi extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['example'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Example'),
      '#default_value' => $this->settings['example'],
      '#description' => $this->t('Description of the setting.'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    /*
    $state = \Drupal::state();
    $a = $state->get('teszt_akarmi', 0);
    $state->set('teszt_akarmi', $a+1)
    */

    // @DCG Process text here.
    $example = $this->settings['example'];
    $text = strtr($text, [
      'alma' => '🍎',
      'körte' => '🍐',
    ]);
    return new FilterProcessResult($text);
  }

  /**
   * {@inheritdoc}
   */
  public function tips($long = FALSE) {
    return $this->t('Some filter tips here.');
  }

}
