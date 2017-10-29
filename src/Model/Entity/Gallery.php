<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Gallery Entity
 *
 * @property int $id
 * @property int $event_id
 * @property int $blog_id
 * @property string $name
 * @property string $cover_image
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 *
 * @property \App\Model\Entity\Event $event
 * @property \App\Model\Entity\Blog $blog
 * @property \App\Model\Entity\GalleryPhoto[] $gallery_photos
 */
class Gallery extends Entity
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
        'gallery_cover_photos'
    ];
	protected function _getGalleryCoverPhotos()
    {
		if(!empty($this->_properties['cover_image']))
		{
        return 'http://app.ucciudaipur.in/webroot/'.$this->_properties['cover_image'];
		}
		else
		{
			return "";
		}
    }
}
