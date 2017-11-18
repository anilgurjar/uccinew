<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CompanyHwmInformation Entity
 *
 * @property int $id
 * @property int $company_id
 * @property string $company_name
 * @property string $waste_description
 * @property string $waste_type_number
 * @property string $process_generating_waste
 * @property string $generation_rate
 * @property string $disposal_arrangement
 * @property string $chemical_composition
 * @property string $company_service_type
 * @property string $chemical_composition_sheet
 * @property string $off_site_company_name
 * @property string $off_site_address
 * @property string $on_site_disposal_method
 * @property string $disposal_waste_use
 * @property string $waste_stream
 * @property string $solid_type
 * @property string $liquid_type
 * @property string $sludge_type
 * @property string $constituents_present
 * @property string $principal_components
 * @property string $acidic_basic
 * @property string $waste_combustible
 * @property string $potential_reuse
 * @property \Cake\I18n\Time $timestamp
 *
 * @property \App\Model\Entity\Company $company
 */
class CompanyHwmInformation extends Entity
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
