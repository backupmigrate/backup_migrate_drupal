<?php
/**
 * @file
 * Contains BackupMigrate\Drupal\Config\DrupalConfigHelper
 */


namespace BackupMigrate\Drupal\Config;


/**
 * Class DrupalConfigHelper
 * @package BackupMigrate\Drupal\Config
 */
class DrupalConfigHelper {

  /**
   * @param array $schema
   *  A configuration schema from one or more Backup and Migrate plugins.
   * @param array $values
   */
  static public function buildFormFromSchema($schema, $values = array()) {
    $form = array();


    foreach ($schema['fields'] as $key => $item) {
      $form_item = array();
      switch ($item['type']) {
        case 'text':
          $form_item['#type'] = 'textfield';
          break;
        case 'boolean':
          $form_item['#type'] = 'checkbox';
          break;
      }

      // If there is a form item add it to the form.
      if ($form_item) {
        // Add the common form elements.
        $form_item['#title'] = $item['title'];
        $form_item['#default_value'] = isset($values) ? $values : $item['default'];

        $form[$key] = $form_item;
      }
    }

    return $form;
  }

  /**
   * @param $schema
   * @param $values
   */
  static public function validateFormFromSchema($schema, $values) {

  }
}