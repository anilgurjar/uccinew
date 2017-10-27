<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Initiative Entity
 *
 * @property int $id
 * @property string $title
 * @property int $initiative_category_id
 * @property string $description
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 * @property \Cake\I18n\Time $edited_on
 * @property int $edited_by
 * @property string $photo
 *
 * @property \App\Model\Entity\InitiativeCategory $initiative_category
 */
class Initiative extends Entity
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
        'photo','image'
    ];
    
	protected function _getPhoto()
    {
		if(!empty($this->_properties['icon_photo']))
		{
			return 'http://app.ucciudaipur.in/webroot/'.$this->_properties['icon_photo'];
		}
		else
		{ return "";}
    }
	
	protected function _getImage()
    {
		if(!empty($this->_properties['description_photo']))
		{
			return 'http://app.ucciudaipur.in/webroot/'.$this->_properties['description_photo'];
		}
		else
		{ return "";}
    }
	
}
