<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CertificateOriginGood Entity
 *
 * @property int $id
 * @property int $certificate_origin_id
 * @property string $marks
 * @property string $container_no
 * @property string $no_and_packing
 * @property string $description_of_goods
 * @property string $quantity
 * @property string $value
 *
 * @property \App\Model\Entity\CertificateOrigin $certificate_origin
 */
class CertificateOriginGood extends Entity
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
