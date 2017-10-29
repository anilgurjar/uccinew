<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CompanyMaster Entity
 *
 * @property int $id
 * @property int $role_id
 * @property string $gst_number
 * @property int $id_card_no
 * @property string $company_organisation
 * @property string $address
 * @property string $city
 * @property int $pincode
 * @property string $end_products_item_dealing_in
 * @property string $office_telephone
 * @property string $residential_telephone
 * @property string $company_email_id
 * @property int $grade
 * @property int $category
 * @property int $classification
 * @property \Cake\I18n\Time $year_of_joining
 * @property int $member_type_id
 * @property int $turn_over_id
 * @property float $due_amount
 * @property int $member_flag
 * @property string $website
 * @property string $tag
 * @property string $infrastructure
 * @property string $brief_description
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\CompanyEmail $company_email
 * @property \App\Model\Entity\MemberType $member_type
 * @property \App\Model\Entity\TurnOver $turn_over
 * @property \App\Model\Entity\MembershipDueAmount[] $membership_due_amounts
 * @property \App\Model\Entity\User[] $users
 */
class CompanyMaster extends Entity
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
