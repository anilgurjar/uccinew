<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CertificateOrigin Entity
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
 *
 * @property \App\Model\Entity\MasterUnit $master_unit
 * @property \App\Model\Entity\MasterCurrency $master_currency
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\CertificateOriginGood[] $certificate_origin_goods
 * @property \App\Model\Entity\MasterCompany $master_company
 */
class CertificateOrigin extends Entity
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
