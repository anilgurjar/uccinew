<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExecutiveMember Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $master_financial_year_id
 * @property int $executive_category_id
 * @property int $designation_id
 * @property string $status
 * @property int $created_by
 * @property \Cake\I18n\Time $created_on
 *
 * @property \App\Model\Entity\ExecutiveMember $executive_member
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\MasterFinancialYear $master_financial_year
 * @property \App\Model\Entity\ExecutiveCategory $executive_category
 * @property \App\Model\Entity\Designation $designation
 */
class ExecutiveMember extends Entity
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
