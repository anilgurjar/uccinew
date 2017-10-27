<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BankDetail Entity
 *
 * @property int $id
 * @property string $account_holder_name
 * @property string $bank_name_and_address
 * @property string $bank_account_number
 * @property string $rtgs_neft_ifs_code
 */
class BankDetail extends Entity
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
