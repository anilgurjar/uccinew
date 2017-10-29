<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventHistory Entity
 *
 * @property int $id
 * @property int $event_id
 * @property string $name
 * @property \Cake\I18n\Time $date
 * @property \Cake\I18n\Time $time
 * @property string $location
 * @property string $latitude
 * @property string $longitude
 * @property string $description
 * @property string $status
 * @property string $cover_image
 * @property \Cake\I18n\Time $edited_on
 * @property int $edited_by
 * @property \Cake\I18n\Time $published_on
 * @property int $published_by
 * @property int $event_category_id
 *
 * @property \App\Model\Entity\Event $event
 * @property \App\Model\Entity\EventCategory $event_category
 */
class EventHistory extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
