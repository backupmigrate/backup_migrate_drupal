<?php

/**
 * @file
 * Contains \Drupal\backup_migrate\Form\SourceForm.
 */

namespace Drupal\backup_migrate\Form;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SourceForm.
 *
 * @package Drupal\backup_migrate\Form
 */
class SourceForm extends EntityForm {
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $backup_migrate_source = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $backup_migrate_source->label(),
      '#description' => $this->t("Label for the Backup Source."),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $backup_migrate_source->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\backup_migrate\Entity\Source::load',
      ),
      '#disabled' => !$backup_migrate_source->isNew(),
    );

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $backup_migrate_source = $this->entity;
    $status = $backup_migrate_source->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Backup Source.', [
          '%label' => $backup_migrate_source->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Backup Source.', [
          '%label' => $backup_migrate_source->label(),
        ]));
    }
    $form_state->setRedirectUrl($backup_migrate_source->urlInfo('collection'));
  }

}
