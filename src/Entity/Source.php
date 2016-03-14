<?php

/**
 * @file
 * Contains \Drupal\backup_migrate\Entity\Source.
 */

namespace Drupal\backup_migrate\Entity;

use BackupMigrate\Core\Config\Config;
use BackupMigrate\Core\Exception\BackupMigrateException;
use Drupal\Core\Cache\RefinableCacheableDependencyInterface;
use Drupal\Core\Config\Entity\ConfigEntityBase;

use BackupMigrate\Core\Source\SourceInterface;
use Drupal\Core\Entity\EntityWithPluginCollectionInterface;
use Drupal\Core\Plugin\DefaultSingleLazyPluginCollection;

/**
 * Defines the Backup Source entity.
 *
 * @ConfigEntityType(
 *   id = "backup_migrate_source",
 *   label = @Translation("Backup Source"),
 *   handlers = {
 *     "list_builder" = "Drupal\backup_migrate\Controller\SourceListBuilder",
 *     "form" = {
 *       "default" = "Drupal\backup_migrate\Form\SourceForm",
 *       "delete" = "Drupal\backup_migrate\Form\SourceDeleteForm"
 *     },
 *   },
 *   admin_permission = "administer backup and migrate",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *     "type" = "type",
 *     "config" = "config"
 *   },
 *   links = {
 *     "canonical" = "/admin/config/development/backup_migrate/settings/source/{backup_migrate_source}",
 *     "add-form" = "/admin/config/development/backup_migrate/settings/source/add",
 *     "edit-form" = "/admin/config/development/backup_migrate/settings/source/{backup_migrate_source}/edit",
 *     "delete-form" = "/admin/config/development/backup_migrate/settings/source/{backup_migrate_source}/delete",
 *     "collection" = "/admin/config/development/backup_migrate/settings/source"
 *   }
 * )
 */
class Source extends WrapperEntityBase {
  /**
   * Return the plugin manager.
   *
   * @return string
   */
  protected function getPluginManager() {
    return \Drupal::service('plugin.manager.backup_migrate_sources');
  }
}
