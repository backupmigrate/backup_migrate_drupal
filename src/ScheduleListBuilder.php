<?php

/**
 * @file
 * Contains \Drupal\backup_migrate\ScheduleListBuilder.
 */

namespace Drupal\backup_migrate;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of Schedule entities.
 */
class ScheduleListBuilder extends ConfigEntityListBuilder {
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Schedule name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultOperations(EntityInterface $entity) {
    $operations = parent::getDefaultOperations($entity);

    if ($entity->hasLinkTemplate('edit-form')) {
      $operations['edit'] = array(
        'title' => t('Edit schedule'),
        'weight' => 20,
        'url' => $entity->urlInfo('edit-form'),
      );
    }
    if ($entity->hasLinkTemplate('delete-form')) {
      $operations['delete'] = array(
        'title' => t('Delete schedule'),
        'weight' => 30,
        'url' => $entity->urlInfo('delete-form'),
      );
    }
    return $operations;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    drupal_set_message(t('The schedule settings have been updated.'));
  }

}
