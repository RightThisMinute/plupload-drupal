<?php

/**
 * @file
 * Contains \Drupal\plupload_test\PluploadTestForm
 */

namespace Drupal\plupload_test;

use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;

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
  public function buildForm(array $form, FormStateInterface $form_state) {
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
  public function validateForm(array &$form, FormStateInterface $form_state) {}

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $submitted_files = array();
    foreach ($form_state->getValue('plupload') as $uploaded_file) {
      if ($uploaded_file['status'] == 'done') {
        $submitted_files[] = \Drupal::config('plupload.settings')->get('temporary_uri') . $uploaded_file['name'];
      }
      else {
        // @todo: move this to element validate or something and clean up t().
        form_set_error('plupload', "Upload of {$uploaded_file['name']} failed");
      }
    }
    if (!empty($submitted_files)) {
      drupal_set_message('Files uploaded correctly: ' . implode(', ', $submitted_files) . '.', 'status');
    }
  }

}
