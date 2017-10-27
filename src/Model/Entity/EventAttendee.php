<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventAttendee Entity
 *
 * @property int $id
 * @property int $event_id
 * @property int $user_id
 * @property string $answer
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 *
 * @property \App\Model\Entity\Event $event
 * @property \App\Model\Entity\User $user
 */
class EventAttendee extends Entity
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
