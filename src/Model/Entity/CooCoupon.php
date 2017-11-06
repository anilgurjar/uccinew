<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CooCoupon Entity
 *
 * @property int $id
 * @property int $company_id
 * @property \Cake\I18n\Time $valid_from
 * @property \Cake\I18n\Time $valid_to
 * @property string $coupon_code
 * @property string $coupon_number
 * @property int $flag
 *
 * @property \App\Model\Entity\Company $company
 */
class CooCoupon extends Entity
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
