<?php

/**
 * @file
 * Contains \Drupal\backup_migrate\Entity\Source.
 */

namespace Drupal\backup_migrate\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\backup_migrate\SourceInterface;

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
class Source extends ConfigEntityBase implements SourceInterface {
  /**
   * The Backup Source ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Backup Source label.
   *
   * @var string
   */
  protected $label;

}
