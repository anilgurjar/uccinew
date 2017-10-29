<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BusinessVisa Entity
 *
 * @property int $id
 * @property int $company_id
 * @property string $sender_address
 * @property string $company_manufacture
 * @property string $subject
 * @property string $visitor_name
 * @property string $visitor_designation
 * @property string $visit_country
 * @property string $visit_month
 * @property string $visit_reason
 * @property string $passport_no
 * @property \Cake\I18n\Time $issue_date
 * @property string $issue_place
 * @property \Cake\I18n\Time $expiry_date
 * @property \Cake\I18n\Time $date_current
 *
 * @property \App\Model\Entity\User $user
 */
class BusinessVisa extends Entity
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
