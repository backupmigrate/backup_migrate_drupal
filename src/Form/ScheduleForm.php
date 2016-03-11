<?php

/**
 * @file
 * Contains \Drupal\backup_migrate\Form\ScheduleForm.
 */

namespace Drupal\backup_migrate\Form;

use BackupMigrate\Drupal\Config\DrupalConfigHelper;
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
      '#title' => $this->t('Schedule Name'),
      '#maxlength' => 255,
      '#default_value' => $backup_migrate_schedule->label(),
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

    $form['enabled'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Schedule enabled'),
      '#default_value' => $backup_migrate_schedule->get('enabled'),
    );

    $bam = backup_migrate_get_service_object([], ['nobrowser' => TRUE]);
    $form['source_id'] = DrupalConfigHelper::getPluginSelector(
      $bam->plugins()->getAllByOp('exportToFile'), t('Backup Source'));
    $form['source_id']['source_id']['#default_value'] = $backup_migrate_schedule->get('source_id');

    $form['destination_id'] = DrupalConfigHelper::getPluginSelector(
      $bam->plugins()->getAllByOp('saveFile'), t('Backup Destination'));
    $form['source_id']['destination_id']['#default_value'] = $backup_migrate_schedule->get('destination_id');

    $form['period'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Frequency'),
      '#default_value' => $backup_migrate_schedule->get('period'),
      '#field_suffix' => $this->t('Seconds'),
      '#size' => 10,
    );

//    $form['keep'] = array(
//      '#type' => 'textfield',
//      '#title' => $this->t('Number to keep'),
//      '#default_value' => $backup_migrate_schedule->get('keep'),
//      '#description' => $this->t('The number of backups to retain. Once this number is reached, the oldest backup will be deleted to make room for the most recent backup. Leave blank to keep all backups.'),
//      '#size' => 10,
//    );

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
