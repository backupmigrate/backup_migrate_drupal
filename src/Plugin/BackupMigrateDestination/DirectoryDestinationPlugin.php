<?php
/**
 * @file
 * Contains ${NAMESPACE}\DirectoryDestinationPlugin
 */

namespace Drupal\backup_migrate\Plugin\BackupMigrateDestination;

use BackupMigrate\Core\Destination\DirectoryDestination;
use BackupMigrate\Drupal\EntityPlugins\DestinationPluginInterface;
use BackupMigrate\Drupal\EntityPlugins\DestinationPluginBase;

/**
 * Defines an mysql source plugin.
 *
 * @BackupMigrateDestinationPlugin(
 *   id = "Directory",
 *   title = @Translation("Server File Directory"),
 *   description = @Translation("Back up to a directory on your web server."),
 * )
 */
class DirectoryDestinationPlugin extends DestinationPluginBase implements DestinationPluginInterface {
  /**
   * Get the Backup and Migrate source object.
   *
   * @return BackupMigrate\Core\Destination\DestinationInterface;
   */
  public function getObject() {
    return new DirectoryDestination($this->getConfig());
  }
}