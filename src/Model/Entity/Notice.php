<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Notice Entity
 *
 * @property int $id
 * @property int $type_of_member
 * @property int $notice_category_id
 * @property string $member_type_id
 * @property string $title
 * @property string $description
 * @property string $file
 *
 * @property \App\Model\Entity\NoticeCategory $notice_category
 * @property \App\Model\Entity\MasterMemberType $master_member_type
 * @property \App\Model\Entity\NoticeMail[] $notice_mails
 * @property \App\Model\Entity\User $user
 */
class Notice extends Entity
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
