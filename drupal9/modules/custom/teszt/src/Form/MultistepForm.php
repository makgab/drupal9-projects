<?php

namespace Drupal\teszt\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Teszt form.
 */
class MultistepForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'teszt_multistep';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $step = $this->getStepId($form_state);
    $form['show_step'] = [
      '#markup' => 'Step: ' . $step,
    ];
    $form['stepForm'] = $this->getStep($form, $form_state, $step);

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['prev'] = [
      '#type' => 'submit',
      '#value' => $this->t('Prev'),
      '#disabled' => $step == 1,
      '#submit' => ['::prevSubmit'],
      '#attributes' => [
        'class' => ['multistep-prev'],
      ],
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send'),
      '#disabled' => $step != 5,
    ];
    $form['actions']['next'] = [
      '#type' => 'submit',
      '#value' => $this->t('Next'),
      '#disabled' => $step == 5,
      '#submit' => ['::nextSubmit'],
      '#attributes' => [
        'class' => ['multistep-next'],
      ],
    ];

    return $form;
  }

  /**
   * Undocumented function
   *
   * @param [type] $step
   * @return void
   */
  private function getStep(array $form, FormStateInterface $form_state, $step) {
    $stepForm = [];
    $stepForm['message' . $step] = [
      '#type' => 'textarea',
      '#title' => $this->t('Message @step', ['@step' => $step]),
      '#required' => TRUE,
      '#default_value' => $form_state->get('message' . $step),
    ];
    return $stepForm;
  }
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $step = $this->getStepId($form_state);
    if (mb_strlen($form_state->getValue('message' . $step)) < 10) {
      $form_state->setErrorByName('message' . $step, $this->t('Message should be at least 10 characters.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('The message has been sent.'));
    $form_state->setRedirect('<front>');
  }

  /**
   * Undocumented function
   *
   * @param array $form
   * @param FormStateInterface $form_state
   * @return void
   */
  public function nextSubmit(array &$form, FormStateInterface $form_state) {
    $step = $this->getStepId($form_state);
    $form_state->set('message' . $step, $form_state->getValue('message' . $step));
    $form_state->set('step', $form_state->get('step') + 1);
    $form_state->setRebuild();
  }

  /**
   * Undocumented function
   *
   * @param array $form
   * @param FormStateInterface $form_state
   * @return void
   */
  public function prevSubmit(array &$form, FormStateInterface $form_state) {
    $step = $this->getStepId($form_state);
    $form_state->set('message' . $step, $form_state->getValue('message' . $step));
    $form_state->set('step', $form_state->get('step') - 1);
    $form_state->setRebuild();
  }

  private function getStepId($form_state) {
    return $form_state->get('step') ?? 1;
  }
}
