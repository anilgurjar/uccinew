<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CompanyWasteInformation Entity
 *
 * @property int $id
 * @property int $company_id
 * @property string $number
 * @property string $waste_type
 * @property string $volume
 * @property string $inventory
 * @property string $storage_method
 * @property string $size_storage_container
 * @property \Cake\I18n\Time $timestamp
 *
 * @property \App\Model\Entity\Company $company
 */
class CompanyWasteInformation extends Entity
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
