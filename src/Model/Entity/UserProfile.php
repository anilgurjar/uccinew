<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserProfile Entity
 *
 * @property int $id
 * @property string $member_name
 * @property int $company_id
 * @property string $email
 * @property string $alternate_email
 * @property string $mobile
 * @property string $alternate_mobile
 * @property string $alternate_member
 * @property string $image
 * @property string $alternate_image
 * @property string $gst_number
 * @property string $company_organisation
 * @property string $address
 * @property string $city
 * @property string $pincode
 * @property string $end_products_item_dealing_in
 * @property string $office_telephone
 * @property string $residential_telephone
 * @property int $grade
 * @property int $category
 * @property int $classification
 * @property \Cake\I18n\Time $year_of_joining
 * @property int $turn_over_id
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\TurnOver $turn_over
 */
class UserProfile extends Entity
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
