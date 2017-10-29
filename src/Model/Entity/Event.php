<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\Time $date
 * @property \Cake\I18n\Time $time
 * @property string $location
 * @property string $latitude
 * @property string $longitude
 * @property string $description
 * @property string $status
 * @property string $cover_image
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 * @property \Cake\I18n\Time $edited_on
 * @property int $edited_by
 * @property \Cake\I18n\Time $published_on
 * @property int $published_by
 * @property int $event_category_id
 *
 * @property \App\Model\Entity\EventAttendee[] $event_attendees
 * @property \App\Model\Entity\EventGuet[] $event_guets
 * @property \App\Model\Entity\EventGuest[] $event_guests
 * @property \App\Model\Entity\EventCategory $event_category
 * @property \App\Model\Entity\Gallery $gallery
 */
class Event extends Entity
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
        'event_day','event_month','event_year','event_date','cover_image_fullpath'
    ];
    
    protected function _getEventDay()
    {
        return date('D', strtotime($this->_properties['date']));
    }
	protected function _getEventDate()
    {
        return date('d M Y', strtotime($this->_properties['date']));
    }
	protected function _getEventYear()
    {
        return date('Y', strtotime($this->_properties['date']));
    }
	protected function _getEventMonth()
    {
        return date('M', strtotime($this->_properties['date']));
    }
	protected function _getCoverImageFullpath()
    {
        return 'http://app.ucciudaipur.in/webroot/'.$this->_properties['cover_image'];
    }
	
}
