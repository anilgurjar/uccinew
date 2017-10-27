<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * NewsLetter Entity
 *
 * @property int $id
 * @property string $title
 * @property string $cover_image
 * @property string $pdf_attachment
 * @property string $description
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 * @property \Cake\I18n\Time $edited_on
 * @property int $edited_by
 * @property int $is_deleted
 */
class NewsLetter extends Entity
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
        'cover_image_fullpath','attachment_fullpath'
    ];
	
	protected function _getCoverImageFullpath()
    {
        return 'http://app.ucciudaipur.in/webroot/'.$this->_properties['cover_image'];
    }
	
	protected function _getAttachmentFullpath()
    {
        return 'http://app.ucciudaipur.in/webroot/'.$this->_properties['pdf_attachment'];
    }
	 
}
