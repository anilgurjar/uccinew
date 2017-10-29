<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SubCommittee Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $designation_id
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 * @property int $status
 * @property int $master_financial_year_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Designation $designation
 * @property \App\Model\Entity\MasterFinancialYear $master_financial_year
 */
class SubCommittee extends Entity
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
