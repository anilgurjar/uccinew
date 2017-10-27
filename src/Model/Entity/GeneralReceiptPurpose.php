<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GeneralReceiptPurpose Entity
 *
 * @property int $id
 * @property int $member_receipt_id
 * @property int $purpose_id
 * @property int $quantity
 * @property float $amount
 * @property float $total
 * @property int $flag
 * @property \Cake\I18n\Time $date_current
 *
 * @property \App\Model\Entity\MemberReceipt $member_receipt
 * @property \App\Model\Entity\MasterPurpose $master_purpose
 */
class GeneralReceiptPurpose extends Entity
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
