<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Supplier Entity
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $company
 * @property string $email
 * @property string $mobile
 * @property string $gst_number
 * @property int $flag
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 *
 * @property \App\Model\Entity\PurchaseOrder[] $purchase_orders
 */
class Supplier extends Entity
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
