<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FacilityBooking Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $expected_person
 * @property \Cake\I18n\Time $date_from
 * @property \Cake\I18n\Time $date_to
 * @property int $venue_id
 * @property float $total_amount
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 * @property string $status
 *
 * @property \App\Model\Entity\Venue $venue
 * @property \App\Model\Entity\User $user
 */
class FacilityBooking extends Entity
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
