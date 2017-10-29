<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SendEmail Entity
 *
 * @property string $subject
 * @property string $content
 * @property \Cake\I18n\Time $date_current
 * @property int $id
 * @property int $flag
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\SendEmailAll[] $send_email_alls
 */
class SendEmail extends Entity
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
