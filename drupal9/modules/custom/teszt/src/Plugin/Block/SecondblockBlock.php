<?php

namespace Drupal\teszt\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a secondblock block.
 *
 * @Block(
 *   id = "teszt_secondblock",
 *   admin_label = @Translation("SecondBlock"),
 *   category = @Translation("Custom")
 * )
 */
class SecondblockBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'foo' => $this->t('Hello world!'),
      'baz' => $this->t('Hello baz!'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['foo'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Foo'),
      '#default_value' => $this->configuration['foo'],
    ];
    $form['baz'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Baz'),
      '#default_value' => $this->configuration['baz'],
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['foo'] = $form_state->getValue('foo');
    $this->configuration['baz'] = $form_state->getValue('baz');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#markup' => $this->configuration['foo'],
    ];
    return $build;
  }

}
