<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MemberFee Entity
 *
 * @property int $id
 * @property int $company_id
 * @property int $company_member_type_id
 * @property int $invoice_no
 * @property int $performa_invoice_no
 * @property float $turn_over_fee
 * @property float $membership_fee
 * @property float $sub_total
 * @property float $tax_amount
 * @property float $grand_total
 * @property \Cake\I18n\Time $date
 * @property \Cake\I18n\Time $invoice_date
 * @property int $mail_send
 * @property int $reminder_mail
 * @property int $flag
 * @property int $master_financial_year_id
 *
 * @property \App\Model\Entity\MemberReceipt[] $member_receipts
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\MemberFeeTaxAmount[] $member_fee_tax_amounts
 */
class MemberFee extends Entity
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
