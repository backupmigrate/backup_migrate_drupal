<?php

/**
 * @file
 * Contains \Drupal\backup_migrate\Entity\Schedule.
 */

namespace Drupal\backup_migrate\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\backup_migrate\ScheduleInterface;

/**
 * Defines the Schedule entity.
 *
 * @ConfigEntityType(
 *   id = "backup_migrate_schedule",
 *   label = @Translation("Schedule"),
 *   module = "backup_migrate",
 *   config_prefix = "schedule",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   handlers = {
 *     "list_builder" = "Drupal\backup_migrate\ScheduleListBuilder",
 *     "form" = {
 *       "default" = "Drupal\backup_migrate\Form\ScheduleForm",
 *       "delete" = "Drupal\backup_migrate\Form\ScheduleDeleteForm"
 *     },
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/development/backup_migrate/schedule/edit/{schedule}",
 *     "delete-form" = "/admin/config/development/backup_migrate/schedule/delete/{schedule}",
 *     "collection" = "/admin/config/development/backup_migrate/schedule",
 *   },
 * )
 */
class Schedule extends ConfigEntityBase implements ScheduleInterface {
  /**
   * The Schedule ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Schedule label.
   *
   * @var string
   */
  protected $label;

}
