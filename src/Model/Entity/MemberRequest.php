<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MemberRequest Entity
 *
 * @property int $id
 * @property string $name
 * @property string $mobile
 * @property string $email
 * @property string $company_name
 * @property string $company_address
 * @property string $designation
 * @property int $master_member_type_id
 * @property string $remarks
 * @property \Cake\I18n\Time $request_date
 * @property int $user_id
 * @property string $website
 *
 * @property \App\Model\Entity\MasterMemberType $master_member_type
 * @property \App\Model\Entity\User $user
 */
class MemberRequest extends Entity
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
