<?php

/**
 * @file
 * Contains \Drupal\backup_migrate\Form\BackupMigrateQuickBackupForm.
 */

namespace Drupal\backup_migrate\Form;

use BackupMigrate\Drupal\Config\DrupalConfigHelper;
use Drupal\Component\Utility\Unicode;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a form for performing a 1-click site backup.
 */
class BackupMigrateAdvancedBackupForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'backup_migrate_ui_manual_backup_advanced';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = array();

    // Theme the form if we want it inline.
    // @FIXME
    // $form['#theme'] = 'backup_migrate_ui_manual_quick_backup_form_inline';

    $form['source'] = array(
      '#type' => 'fieldset',
      "#title" => t("Source"),
      "#collapsible" => TRUE,
      "#collapsed" => FALSE,
      "#tree" => FALSE,
    );

//    $values = $form_state['values'];

    $bam = backup_migrate_get_service_object();

    $conf_schema = $bam->plugins()->call('configSchema', array(), array('operation' => 'backup'));
    $form += DrupalConfigHelper::buildFormFromSchema($conf_schema, $values);

    // $form['quickbackup']['source_id'] = _backup_migrate_get_source_pulldown(\Drupal::config('backup_migrate.settings')->get('backup_migrate_source_id'));
    // $form['quickbackup']['destination'] = _backup_migrate_get_destination_pulldown('manual backup', \Drupal::config('backup_migrate.settings')->get('backup_migrate_destination_id'), \Drupal::config('backup_migrate.settings')->get('backup_migrate_copy_destination_id'));

    $form['quickbackup']['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Backup now'),
      '#weight' => 1,
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    $conf_schema = $bam->plugins()->call('configSchema', array(), array('operation' => 'backup'));
    DrupalConfigHelper::validateFormFromSchema($conf_schema, $form_state['values']);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $form_state['values'];
    backup_migrate_perform_backup('db', 'download', $config);
  }


}
