<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MemberReceipt Entity
 *
 * @property int $receipt_id
 * @property int $member_fee_id
 * @property int $receipt_no
 * @property int $company_id
 * @property int $purpose_id
 * @property string $amount_type
 * @property int $bank_id
 * @property string $drawn_bank
 * @property string $cheque_no
 * @property \Cake\I18n\Time $cheque_date
 * @property float $basic_amount
 * @property float $taxamount
 * @property float $amount
 * @property float $tds_amount
 * @property string $narration
 * @property int $mail_send
 * @property int $sms_send
 * @property \Cake\I18n\Time $date_current
 * @property int $receipt_flag
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\MasterMemberType $master_member_type
 * @property \App\Model\Entity\MasterBank $master_bank
 * @property \App\Model\Entity\MasterPurpose $master_purpose
 * @property \App\Model\Entity\MemberFee $member_fee
 * @property \App\Model\Entity\MasterTaxation $master_taxation
 * @property \App\Model\Entity\MasterTaxationRate $master_taxation_rate
 * @property \App\Model\Entity\MasterMembershipFee $master_membership_fee
 * @property \App\Model\Entity\MasterTurnOver $master_turn_over
 * @property \App\Model\Entity\GeneralReceiptPurpose[] $general_receipt_purposes
 * @property \App\Model\Entity\TaxAmount[] $tax_amounts
 * @property \App\Model\Entity\MasterCompany $master_company
 * @property \App\Model\Entity\BankDetail $bank_detail
 */
class MemberReceipt extends Entity
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
        'receipt_id' => false
    ];
}
