<?php
/**
 * @file
 */

namespace Drupal\backup_migrate\Controller;


use BackupMigrate\Core\Destination\DestinationInterface;
use BackupMigrate\Core\Destination\ListableDestinationInterface;
use Drupal\backup_migrate\Entity\Destination;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

/**
 * Class BackupController
 * @package Drupal\backup_migrate\Controller
 */
class BackupController extends ControllerBase {

  /**
   * @var DestinationInterface
   */
  var $destination;


  /**
   * @param \BackupMigrate\Core\Destination\ListableDestinationInterface $destination
   */
  public function listAll(Destination $backup_migrate_destination) {
    $destination = $backup_migrate_destination->getObject();
    $backups = $destination->listFiles();

    $rows = [];
    $header = array(
      array(
        'data' => $this->t('Name'),
        'class' => array(RESPONSIVE_PRIORITY_MEDIUM)),
      array(
        'data' => $this->t('Date'),
        'class' => array(RESPONSIVE_PRIORITY_MEDIUM)),
      array(
        'data' => $this->t('Size'),
        'class' => array(RESPONSIVE_PRIORITY_MEDIUM)),
      array(
        'data' => $this->t('Operations'),
        'class' => array(RESPONSIVE_PRIORITY_LOW)),
    );

    foreach ($backups as $backup_id => $backup) {
      $rows[] = [
        'data' => [
          // Cells.
          $backup->getFullName(),
          \Drupal::service('date.formatter')->format($backup->getMeta('datestamp')),
          format_size($backup->getMeta('filesize')),
          [
            'data' => [
              '#type' => 'operations',
              '#links' => [
                'restore' => [
                  'title' => $this->t('Restore'),
                  'url' => Url::fromRoute(
                    'entity.backup_migrate_destination.backup_restore',
                    [
                      'backup_migrate_destination' => $backup_migrate_destination->id(),
                      'backup_id' => $backup_id
                    ]
                  )
                ],
                'download' => [
                  'title' => $this->t('Download'),
                  'url' => Url::fromRoute(
                    'entity.backup_migrate_destination.backup_download',
                    [
                      'backup_migrate_destination' => $backup_migrate_destination->id(),
                      'backup_id' => $backup_id
                    ]
                  )
                ],
                'delete' => [
                  'title' => $this->t('Delete'),
                  'url' => Url::fromRoute(
                    'entity.backup_migrate_destination.backup_delete',
                    [
                      'backup_migrate_destination' => $backup_migrate_destination->id(),
                      'backup_id' => $backup_id
                    ]
                  )
                ],
              ]
            ]
          ],
        ],
      ];
    }

    $build['backups_table'] = array(
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => $this->t('There are no backups in this destination.'),
    );

    return $build;
  }

  /**
   * @param \Drupal\backup_migrate\Entity\Destination $backup_migrate_destination
   * @param $backup_id
   */
  public function delete(Destination $backup_migrate_destination, $backup_id) {

  }

  /**
   * @param \Drupal\backup_migrate\Entity\Destination $backup_migrate_destination
   * @param $backup_id
   */
  public function download(Destination $backup_migrate_destination, $backup_id) {

  }

  /**
   * @param \Drupal\backup_migrate\Entity\Destination $backup_migrate_destination
   * @param $backup_id
   */
  public function restore(Destination $backup_migrate_destination, $backup_id) {

  }

}

