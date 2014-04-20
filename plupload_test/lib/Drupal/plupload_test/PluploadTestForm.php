<?php

/**
 * @file
 * Contains \Drupal\plupload_test\PluploadTestForm
 */

namespace Drupal\plupload_test;

use Drupal\Core\Form\FormInterface;

/**
 * Plupload test form class.
 */
class PluploadTestForm implements FormInterface {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return '_plupload_test_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {
    $form['plupload'] = array(
      '#type' => 'plupload'
    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, array &$form_state) {}

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    dpm($form_state);
  }
}
