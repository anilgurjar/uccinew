<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CompanyWastageInformation Entity
 *
 * @property int $id
 * @property int $company_id
 * @property string $code_hm_rule
 * @property string $waste_description_incinerable
 * @property string $waste_description_non
 * @property string $quantity_month_incinerable
 * @property string $quantity_month_non
 * @property string $inventory_incinerable
 * @property string $inventory_non
 * @property string $storage_method_incinerable
 * @property string $storage_method_non
 * @property \Cake\I18n\Time $timestamp
 *
 * @property \App\Model\Entity\Company $company
 */
class CompanyWastageInformation extends Entity
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
