<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GratitudeLetter Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $send_status
 *
 * @property \App\Model\Entity\MasterCompany $master_company
 * @property \App\Model\Entity\User $user
 */
class GratitudeLetter extends Entity
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
