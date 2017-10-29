<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HomeMenu Entity
 *
 * @property int $id
 * @property string $name
 */
class HomeMenu extends Entity
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
        'link','image_fullpath'
    ];
    
	protected function _getLink()
    {
        return 'http://app.ucciudaipur.in/api/'.$this->_properties['link'];
    }
	protected function _getImageFullpath()
    {
        return 'http://app.ucciudaipur.in/webroot/'.$this->_properties['image'];
    }
}
