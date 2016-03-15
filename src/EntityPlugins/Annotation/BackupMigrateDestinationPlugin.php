<?php

/**
 * @file
 * Contains \Drupal\backup_migrate\EntityPlugins\Annotation\BackupMigrateDestinationPlugin.
 */

namespace BackupMigrate\Drupal\EntityPlugins\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines an source plugin annotation object.
 *
 * Plugin Namespace: Plugin\BackupMigrateDestinationPlugin
 *
 * @Annotation
 */
class BackupMigrateDestinationPlugin extends Plugin {

  /**
   * The source plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The human-readable name of the source plugin.
   *
   * @ingroup plugin_translatable
   *
   * @var \Drupal\Core\Annotation\Translation
   */
  public $title;

  /**
   * The description of the source plugin.
   *
   * @ingroup plugin_translatable
   *
   * @var \Drupal\Core\Annotation\Translation
   */
  public $description;

}
