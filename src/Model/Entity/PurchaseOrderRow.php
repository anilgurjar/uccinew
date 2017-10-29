<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseOrderRow Entity
 *
 * @property int $id
 * @property int $purchase_order_id
 * @property string $item_name
 * @property string $quty
 * @property string $rate
 * @property string $amount
 * @property \Cake\I18n\Time $date
 * @property string $time
 *
 * @property \App\Model\Entity\PurchaseOrder $purchase_order
 */
class PurchaseOrderRow extends Entity
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
	protected $_virtual = [
        'date'
    ];
	
	protected function _getDate()
    {
		if(!empty($this->_properties['date']))
		{
			return date("Y-m-d",strtotime($this->_properties['date']));
		}
		else
		{ return "0000-00-00";}
    }
}
