<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MasterTaxation Entity
 *
 * @property int $tax_id
 * @property string $tax_name
 * @property int $tax_flag
 * @property string $gst_name
 *
 * @property \App\Model\Entity\Tax $tax
 * @property \App\Model\Entity\MasterTaxationRate[] $master_taxation_rates
 */
class MasterTaxation extends Entity
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
        'tax_id' => false
    ];
}
