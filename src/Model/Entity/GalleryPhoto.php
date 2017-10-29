<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GalleryPhoto Entity
 *
 * @property int $id
 * @property int $gallery_id
 * @property string $image
 * @property string $description
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 *
 * @property \App\Model\Entity\Gallery $gallery
 */
class GalleryPhoto extends Entity
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
        'image_fullpath'
    ];
	protected function _getImageFullpath()
    {
		if(!empty($this->_properties['image']))
		{
			return 'http://app.ucciudaipur.in/webroot/'.$this->_properties['image'];		}
		else
		{
			return "";
		}
    }
        
}
