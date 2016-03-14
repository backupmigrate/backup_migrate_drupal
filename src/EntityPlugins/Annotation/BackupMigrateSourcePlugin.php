<?php

/**
 * @file
 * Contains \Drupal\Core\Archiver\Annotation\Archiver.
 */

namespace BackupMigrate\Drupal\EntityPlugins\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines an source plugin annotation object.
 *
 * Plugin Namespace: Plugin\BackupMigrateSourcePlugin
 *
 * @Annotation
 */
class BackupMigrateSourcePlugin extends Plugin {

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
