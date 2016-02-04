<?php

/**
 * @file
 * Contains \Drupal\backup_migrate\Form\ScheduleForm.
 */

namespace Drupal\backup_migrate\Form;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ScheduleForm.
 *
 * @package Drupal\backup_migrate\Form
 */
class ScheduleForm extends EntityForm {
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $backup_migrate_schedule = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $backup_migrate_schedule->label(),
      '#description' => $this->t("Label for the Schedule."),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $backup_migrate_schedule->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\backup_migrate\Entity\Schedule::load',
      ),
      '#disabled' => !$backup_migrate_schedule->isNew(),
    );

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $backup_migrate_schedule = $this->entity;
    $status = $backup_migrate_schedule->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Schedule.', [
          '%label' => $backup_migrate_schedule->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Schedule.', [
          '%label' => $backup_migrate_schedule->label(),
        ]));
    }
    $form_state->setRedirectUrl($backup_migrate_schedule->urlInfo('collection'));
  }

}
