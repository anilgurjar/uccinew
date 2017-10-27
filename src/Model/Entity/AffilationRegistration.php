<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AffilationRegistration Entity
 *
 * @property int $id
 * @property string $logo
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 */
class AffilationRegistration extends Entity
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
        'fullpath_image'
    ];
    
	protected function _getFullpathImage()
    {
        return 'http://app.ucciudaipur.in/webroot/'.$this->_properties['logo'];
    }
}
