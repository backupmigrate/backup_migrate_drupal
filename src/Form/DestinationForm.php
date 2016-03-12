<?php

/**
 * @file
 * Contains \Drupal\backup_migrate\Form\DestinationForm.
 */

namespace Drupal\backup_migrate\Form;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class DestinationForm.
 *
 * @package Drupal\backup_migrate\Form
 */
class DestinationForm extends EntityForm {
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $backup_migrate_destination = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $backup_migrate_destination->label(),
      '#description' => $this->t("Label for the Backup Destination."),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $backup_migrate_destination->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\backup_migrate\Entity\Destination::load',
      ),
      '#disabled' => !$backup_migrate_destination->isNew(),
    );

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $backup_migrate_destination = $this->entity;
    $status = $backup_migrate_destination->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Backup Destination.', [
          '%label' => $backup_migrate_destination->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Backup Destination.', [
          '%label' => $backup_migrate_destination->label(),
        ]));
    }
    $form_state->setRedirectUrl($backup_migrate_destination->urlInfo('collection'));
  }

}
