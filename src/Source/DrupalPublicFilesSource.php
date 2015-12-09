<?php
/**
 * @file
 * Contains BackupMigrate\Drupal\Source\DrupalPublicFilesSource
 */


namespace BackupMigrate\Drupal\Source;


use BackupMigrate\Core\Config\Config;
use BackupMigrate\Core\Source\FileDirectorySource;

/**
 * Class DrupalPublicFilesSource
 * @package BackupMigrate\Drupal\Source
 */
class DrupalPublicFilesSource extends FileDirectorySource {

  // @TODO: Add configuration defaults for excluded files
  // @TODO: Allow modules to add their own excluded defaults
  // @TODO: Fix the directory to 'public://'

  /**
   * Get the default values for the plugin.
   *
   * @return \BackupMigrate\Core\Config\Config
   */
  public function configDefaults() {
    $config = [
      'exclude_filepaths' => [
        'js',
        'css',
        'php',
        '.htaccess',
      ],
      'directory' => 'public://',
    ];

    return new Config($config);
  }
}