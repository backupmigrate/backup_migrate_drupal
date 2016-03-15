<?php
/**
 * @file
 * Contains BackupMigrate\Drupal\Source\MySQLSourcePlugin
 */


namespace Drupal\backup_migrate\Plugin\BackupMigrateSource;

use BackupMigrate\Core\Config\Config;
use BackupMigrate\Core\Source\MySQLiSource;
use BackupMigrate\Drupal\EntityPlugins\SourcePluginInterface;
use BackupMigrate\Drupal\EntityPlugins\SourcePluginBase ;

/**
 * Defines an mysql source plugin.
 *
 * @BackupMigrateSourcePlugin(
 *   id = "MySQL",
 *   title = @Translation("MySQL"),
 *   description = @Translation("Backs up MySQL compatible databases."),
 * )
 */
class MySQLSourcePlugin extends SourcePluginBase implements SourcePluginInterface {
  /**
   * Get the Backup and Migrate source object.
   *
   * @return BackupMigrate\Core\Source\SourceInterface;
   */
  public function getObject() {
    return new MySQLiSource($this->getConfig());
  }
}