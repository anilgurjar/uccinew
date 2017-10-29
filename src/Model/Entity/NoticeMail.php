<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * NoticeMail Entity
 *
 * @property int $id
 * @property int $notice_id
 * @property int $user_id
 * @property string $alternate
 * @property int $status
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Notice $notice
 */
class NoticeMail extends Entity
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
