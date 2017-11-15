<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InvoiceAttestation Entity
 *
 * @property int $id
 * @property int $company_id
 * @property int $origin_no
 * @property string $exporter
 * @property string $consignee
 * @property string $invoice_no
 * @property \Cake\I18n\Time $invoice_date
 * @property string $manufacturer
 * @property string $despatched_by
 * @property string $port_of_loading
 * @property string $final_destination
 * @property string $port_of_discharge
 * @property int $unit_id
 * @property int $currency_id
 * @property \Cake\I18n\Time $date_current
 * @property int $approve
 * @property string $transaction_id
 * @property string $payment_status
 * @property int $approved_by
 * @property \Cake\I18n\Time $approve_on
 * @property string $payment_amount
 * @property string $payment_tax_amount
 * @property string $show_amount
 * @property string $invoice_attachment
 * @property string $currency_unit
 * @property string $other_info
 * @property float $total_before_discount
 * @property float $discount
 * @property float $freight_amount
 * @property float $total_amount
 * @property string $status
 * @property string $coo_mail
 * @property int $verify_by
 * @property \Cake\I18n\Time $verify_on
 * @property string $verify_remarks
 * @property string $authorised_remarks
 * @property int $authorised_by
 * @property \Cake\I18n\Time $authorised_on
 * @property string $payment_type
 *
 * @property \App\Model\Entity\Currency $currency
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\Unit $unit
 * @property \App\Model\Entity\Transaction $transaction
 */
class InvoiceAttestation extends Entity
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
