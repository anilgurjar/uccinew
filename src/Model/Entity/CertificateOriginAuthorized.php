<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CertificateOriginAuthorized Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $created_by
 * @property \Cake\I18n\Time $created_on
 * @property int $edited_by
 * @property \Cake\I18n\Time $edited_on
 *
 * @property \App\Model\Entity\User $user
 */
class CertificateOriginAuthorized extends Entity
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
