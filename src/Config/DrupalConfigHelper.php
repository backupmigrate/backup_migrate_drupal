<?php
/**
 * @file
 * Contains BackupMigrate\Drupal\Config\DrupalConfigHelper
 */


namespace BackupMigrate\Drupal\Config;

use BackupMigrate\Core\Config\Config;
use Drupal\Core\Form\FormStateInterface;


/**
 * Class DrupalConfigHelper
 * @package BackupMigrate\Drupal\Config
 */
class DrupalConfigHelper {

  /**
   * @param array $schema
   *  A configuration schema from one or more Backup and Migrate plugins.
   * @param \BackupMigrate\Core\Config\ConfigInterface $config
   * @return array
   */
  static public function buildFormFromSchema($schema, ConfigInterface $config, $parents = []) {
    $form = array();

    foreach ($schema as $plugin_key => $plugin_schema) {
      // Get the configuration for the plugin to use as the form default values.
      $plugin_config = $config->get($plugin_key);

      // Add the specified groups.
      foreach ($plugin_schema['groups'] as $group_key => $item) {
        if (!isset($form[$group_key])) {
          $form[$group_key] = [
            '#type' => 'fieldset',
            '#title' => $item['title'],
            '#tree' => FALSE,
          ];
        }
      }

      // Add each of the fields.
      foreach ($plugin_schema['fields'] as $field_key => $item) {
        $form_item = array();
        $value = $plugin_config->get($field_key);

        switch ($item['type']) {
          case 'text':
            $form_item['#type'] = 'textfield';
            if (!empty($item['multiple'])) {
              $form_item['#type'] = 'textarea';
              $form_item['#description'] .= ' ' . t('Add one item per line.');
              $form_item['#element_validate'] = [[new DrupalConfigHelper, 'validateMultiText']];
              $value  = implode("\n", $plugin_config->get($field_key));
            }
            if (!empty($item['multiline'])) {
              $form_item['#type'] = 'textarea';
            }
            break;
          case 'password':
            $form_item['#type'] = 'password';
            break;
          case 'number':
            $form_item['#type'] = 'textfield';
            $form_item['#size'] = 5;
            if (!empty($item['max'])) {
              $form_item['#size'] = strlen((string)$item['max']) + 3;
            }

            break;
          case 'boolean':
            $form_item['#type'] = 'checkbox';
            break;
          case 'enum':
            $form_item['#type'] = 'select';
            $form_item['#multiple'] = !empty($item['multiple']);
            if (empty($item['#required']) && empty($item['multiple'])) {
              $item['options'] = array('' => '--' . t('None') . '--') + $item['options'];
            }
            $form_item['#options'] = $item['options'];
            break;
        }

        // If there is a form item add it to the form.
        if ($form_item) {
          // Add the common form elements.
          $form_item['#title'] = $item['title'];
          $form_item['#parents'] = array_merge($parents, array($plugin_key, $field_key));
          $form_item['#required'] = !empty($item['required']);
          $form_item['#default_value'] = $value;

          if (!empty($item['description'])) {
            $form_item['#description'] = $item['description'];
          }

          // Add the field to it's group or directly to the top level of the form.
          if (!empty($item['group'])) {
            $form[$item['group']][$field_key] = $form_item;
          }
          else {
            $form[$field_key] = $form_item;
          }
        }
      }
    }

    return $form;
  }

  /**
   * Break a multi-line text value into an array.
   *
   * @param $element
   * @param $form_state
   */
  public static function validateMultiText(&$element, FormStateInterface &$form_state) {
    $form_state->setValueForElement($element, array_map('trim', explode("\n", $element['#value'])));
  }

  /**
   * Get a pulldown for the given list of plugins
   *
   * @param \BackupMigrate\Core\Config\ConfigurableInterface[] $plugins
   * @return array
   */
  public static function getPluginSelector($plugins, $title) {
    $options = array();
    foreach ($plugins as $key => $plugin) {
      $options[$key] = $plugin->confGet('name', $key);
    }
    return [
      '#type' => 'select',
      '#title' => $title,
      '#options' => $options,
    ];
  }
}