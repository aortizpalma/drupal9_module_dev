<?php

namespace Drupal\goodbye_world\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form definition for the farewell message.
 */
class FarewellConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['goodbye_world.custom_farewell'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'farewell_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('goodbye_world.custom_farewell');

    $form['farewell'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Farewell'),
      '#description' => $this->t('Please provide the farewell you want to use.'),
      '#default_value' => $config->get('farewell'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('goodbye_world.custom_farewell')
      ->set('farewell', $form_state->getValue('farewell'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
