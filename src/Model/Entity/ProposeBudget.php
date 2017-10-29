<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProposeBudget Entity
 *
 * @property int $id
 * @property int $master_purpose_id
 * @property \Cake\I18n\Time $financial_year_from
 * @property \Cake\I18n\Time $financial_year_to
 * @property float $expenditure_amount
 * @property float $receipt_amount
 * @property \Cake\I18n\Time $date_current
 * @property int $user_id
 *
 * @property \App\Model\Entity\MasterFinancialYear $master_financial_year
 * @property \App\Model\Entity\MasterPurpose $master_purpose
 * @property \App\Model\Entity\User $user
 */
class ProposeBudget extends Entity
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
