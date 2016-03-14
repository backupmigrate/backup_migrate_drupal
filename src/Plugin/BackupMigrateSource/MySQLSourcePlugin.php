<?php
/**
 * @file
 * Contains BackupMigrate\Drupal\Source\MySQLSourcePlugin
 */


namespace Drupal\backup_migrate\Plugin\BackupMigrateSource;

use BackupMigrate\Core\Config\Config;
use BackupMigrate\Core\Main\BackupMigrateInterface;
use BackupMigrate\Core\Source\MySQLiSource;
use BackupMigrate\Drupal\EntityPlugins\SourcePluginInterface;
use BackupMigrate\Core\Source\SourceInterface;
use BackupMigrate\Drupal\EntityPlugins\WrapperPluginBase;
use Drupal\Component\Plugin\PluginBase;

/**
 * Defines an mysql source plugin.
 *
 * @BackupMigrateSourcePlugin(
 *   id = "MySQL",
 *   title = @Translation("MySQL"),
 *   description = @Translation("Backs up MySQL compatible databases."),
 * )
 */
class MySQLSourcePlugin extends WrapperPluginBase implements SourcePluginInterface {
  /**
   * Get the Backup and Migrate source object.
   *
   * @return BackupMigrate\Core\Source\SourceInterface;
   */
  public function getObject() {
    $config = new Config($this->configuration);
    return new MySQLiSource($config);
  }
}