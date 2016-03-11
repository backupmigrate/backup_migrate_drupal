<?php

/**
 * @file
 * Contains \Drupal\backup_migrate\SettingsProfileListBuilder.
 */

namespace Drupal\backup_migrate\Controller;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of Settings Profile entities.
 */
class SettingsProfileListBuilder extends ConfigEntityListBuilder {
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Profile Name');
    $header['id'] = $this->t('Machine name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    $row['id'] = $entity->id();
    // You probably want a few more properties here...
    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultOperations(EntityInterface $entity) {
    $operations = parent::getDefaultOperations($entity);

    if ($entity->hasLinkTemplate('edit-form')) {
      $operations['edit'] = array(
        'title' => t('Edit profile'),
        'weight' => 20,
        'url' => $entity->urlInfo('edit-form'),
      );
    }
    if ($entity->hasLinkTemplate('delete-form')) {
      $operations['delete'] = array(
        'title' => t('Delete profile'),
        'weight' => 30,
        'url' => $entity->urlInfo('delete-form'),
      );
    }
    return $operations;
  }
}
