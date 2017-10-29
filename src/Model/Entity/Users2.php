<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Users2 Entity
 *
 * @property int $id
 * @property int $role_id
 * @property string $gst_number
 * @property int $id_card_no
 * @property string $company_organisation
 * @property string $member_name
 * @property string $alternate_nominee
 * @property string $address
 * @property string $city
 * @property int $pincode
 * @property string $pan_no
 * @property string $end_products_item_dealing_in
 * @property string $office_telephone
 * @property string $residential_telephone
 * @property string $email
 * @property string $password
 * @property string $alternate_email
 * @property string $mobile_no
 * @property string $alternate_mobile_no
 * @property int $grade
 * @property int $category
 * @property int $classification
 * @property \Cake\I18n\Time $year_of_joining
 * @property int $member_type_id
 * @property int $turn_over_id
 * @property float $due_amount
 * @property int $id_card_email
 * @property int $id_card_alternate_email
 * @property string $passkey
 * @property int $timeout
 * @property int $member_flag
 * @property string $facebook_account
 * @property string $gmail_account
 * @property string $device_token
 * @property string $member_designation
 * @property string $alternate_designation
 * @property string $website
 * @property string $social_id
 * @property string $login_by
 * @property string $fb_user_id
 * @property string $fb_token
 * @property string $google_token
 * @property string $google_auth
 * @property string $tag
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\MemberType $member_type
 * @property \App\Model\Entity\TurnOver $turn_over
 * @property \App\Model\Entity\Social $social
 * @property \App\Model\Entity\FbUser $fb_user
 */
class Users2 extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
