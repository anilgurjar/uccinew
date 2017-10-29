<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CoRegistration Entity
 *
 * @property int $id
 * @property int $company_id
 * @property int $master_financial_year_id
 * @property float $amount
 * @property float $tax_amount
 * @property float $total_amount
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\MasterFinancialYear $master_financial_year
 * @property \App\Model\Entity\CoTaxAmount[] $co_tax_amounts
 */
class CoRegistration extends Entity
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
