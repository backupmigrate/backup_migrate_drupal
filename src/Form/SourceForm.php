<?php

/**
 * @file
 * Contains \Drupal\backup_migrate\Form\SourceForm.
 */

namespace Drupal\backup_migrate\Form;

use BackupMigrate\Drupal\Config\DrupalConfigHelper;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SourceForm.
 *
 * @package Drupal\backup_migrate\Form
 */
class SourceForm extends WrapperEntityForm {
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $form['type'] = array(
      '#type' => 'select',
      '#title' => $this->t('Source Type'),
    );
    foreach (\Drupal::service('plugin.manager.backup_migrate_sources')->getDefinitions() as $type) {
      $form['type']['#options'][$type['id']] = $type['title'];
    }

    if ($source = $this->entity->getObject()) {
      $conf_schema = $source->configSchema(['operation' => 'initialize']);
      $form['config'] = DrupalConfigHelper::buildFormFromSchemaSingle($conf_schema, $source->config(), ['config']);
    }

    return $form;
  }

}
