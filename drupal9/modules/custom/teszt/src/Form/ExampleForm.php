<?php

namespace Drupal\teszt\Form;

use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a Teszt form.
 */
class ExampleForm extends FormBase {

  private $database;
  public function __construct(Connection $database)
  {
    $this->database = $database;
  }

  public static function create(ContainerInterface $container)
  {
    return new static($container->get('database'));
  }
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'teszt_example';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $id = null) {
    $message = '';
    if ($id !== null) {
      $message = $this->database->select('teszt_messages', 't')
      ->fields('t', ['message'])
      ->condition('id', $id)
      ->execute()
      ->fetchField();
      $form_state->set('id', $id);
    }
    $form['messages'] = [
      '#type' => 'table',
      '#rows' => $this->getRows(),
    ];

    $form['message_info'] = array(
      '#type' => 'fieldset',
      '#title' => $this
        ->t('Message Info'),
    );
    $form['message_info']['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Message'),
      '#required' => TRUE,
      '#default_value' => $message,
    ];
    $form['message_info']['copy'] = array(
      '#type' => 'checkbox',
      '#title' => $this
        ->t('Send me a copy'),
    );
    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send'),
    ];
    if ($id !== null) {
      $form['actions']['delete'] = [
        '#type' => 'submit',
        '#value' => $this->t('Delete'),
        '#submit' => ['::deleteMessage'],
      ];
      
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (mb_strlen($form_state->getValue('message')) < 10) {
      $form_state->setErrorByName('message', $this->t('Message should be at least 10 characters.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $id = $form_state->get('id');
    if ($id === null){
      $query = $this->database->insert('teszt_messages');
      $query->fields([
        'message' => $form_state->getValue('message'),
      ]);
      $query->execute();
    }
    else {
      $query = $this->database->update('teszt_messages');
      $query->fields([
          'message' => $form_state->getValue('message'),
        ]);
      $query->condition('id', $id)
      ->execute();
    }

    $this->messenger()->addStatus($this->t('The message has been sent.'));
    //$form_state->setRedirect('<front>');
  }
  /**
   * Delete message
   *
   * @param array $form
   * @param FormStateInterface $form_state
   * @return void
   */
  public function deleteMessage(array &$form, FormStateInterface $form_state) {
    $id = $form_state->get('id');
    $this->database->delete('teszt_messages')
    ->condition('id', $id)
    ->execute();
    $form_state->setRedirect('teszt.message.new');
  }

  private function getRows() {
    $result = $this->database->select('teszt_messages', 't')
    ->fields('t', ['message', 'id'])
    ->execute();
    $rows = [];
    foreach($result as $row) {
      $message = Link::createFromRoute($row->message, 'teszt.message.edit', ['id' => $row->id]);
      $rows[] = [$message];
    }
    return $rows;
  }
}
