<?php
/**
 * @file
 * Contains BackupMigrate\Drupal\Source\DrupalPublicFilesSource
 */


namespace BackupMigrate\Drupal\Source;


use BackupMigrate\Core\Source\FileDirectorySource;

/**
 * Class DrupalPublicFilesSource
 * @package BackupMigrate\Drupal\Source
 */
class DrupalPublicFilesSource extends FileDirectorySource {

  // @TODO: Add configuration defaults for excluded files
  // @TODO: Allow modules to add their own excluded defaults
  // @TODO: Fix the directory to 'public://'
}