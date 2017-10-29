<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MembershipDueAmount Entity
 *
 * @property int $id
 * @property int $company_master_id
 * @property int $member_type_id
 * @property float $due_amount
 * @property int $flag
 *
 * @property \App\Model\Entity\CompanyMaster $company_master
 * @property \App\Model\Entity\MemberType $member_type
 */
class MembershipDueAmount extends Entity
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
