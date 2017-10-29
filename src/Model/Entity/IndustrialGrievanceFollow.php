<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * IndustrialGrievanceFollow Entity
 *
 * @property int $id
 * @property string $department_content
 * @property int $industrial_grievance_id
 * @property string $ucci_content
 * @property \Cake\I18n\Time $follow_date
 *
 * @property \App\Model\Entity\IndustrialGrievance $industrial_grievance
 * @property \App\Model\Entity\User $user
 */
class IndustrialGrievanceFollow extends Entity
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
