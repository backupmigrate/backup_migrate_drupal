<?php
/**
 * @file
 * Contains Drupal\backup_migrate\Entity\WrapperEntityBase
 */


namespace Drupal\backup_migrate\Entity;


use Drupal\Component\Plugin\PluginManagerInterface;
use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Entity\EntityWithPluginCollectionInterface;
use Drupal\Core\Plugin\DefaultSingleLazyPluginCollection;

/**
 * A configuration entity that wraps a Backup and Migrate plugin.
 *
 * This base allows a configuration entity to use any B&M source or destination by
 * using Drupal's plugin system.
 *
 * Class WrapperEntityBase
 * @package Drupal\backup_migrate\Entity
 */
abstract class WrapperEntityBase extends ConfigEntityBase implements EntityWithPluginCollectionInterface {
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

  /**
   * The plugin collection that holds the block plugin for this entity.
   *
   * @var \Drupal\block\BlockPluginCollection
   */
  protected $pluginCollection;

  /**
   * @return SourcePluginInterface
   * @throws \BackupMigrate\Core\Exception\BackupMigrateException
   */
  public function getObject() {
    if ($plugin = $this->getPlugin()) {
      return $plugin->getObject();
    }
  }

  /**
   * Get the type plugin for this source
   *
   * @return mixed
   * @throws \BackupMigrate\Core\Exception\BackupMigrateException
   */
  public function getPlugin() {
    if ($this->get('type')) {
      return $this->getPluginCollection()->get($this->get('type'));
    }
    return null;
  }

  /**
   * Gets the plugin collections used by this entity.
   *
   * @return \Drupal\Component\Plugin\LazyPluginCollection[]
   *   An array of plugin collections, keyed by the property name they use to
   *   store their configuration.
   */
  public function getPluginCollections() {
    return ['config' => $this->getPluginCollection()];
  }

  /**
   * @return \Drupal\block\BlockPluginCollection
   */
  public function getPluginCollection() {
    if ($this->get('type')) {
      if (!$this->pluginCollection) {
        $config = ['name' => $this->get('label')] + (array)$this->get('config');
        $this->pluginCollection = new DefaultSingleLazyPluginCollection(
          $this->getPluginManager(), $this->get('type'), $config);
      }
      return $this->pluginCollection;
    }
    return [];
  }

  /**
   * Return the plugin manager.
   *
   * @return PluginManagerInterface
   */
  abstract protected function getPluginManager();
}
