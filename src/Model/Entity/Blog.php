<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Blog Entity
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $cover_image
 * @property int $published_by
 * @property \Cake\I18n\Time $created_on
 * @property int $created_by
 * @property string $status
 * @property \Cake\I18n\Time $edited_on
 * @property int $edited_by
 * @property \Cake\I18n\Time $published_on
 *
 * @property \App\Model\Entity\BlogLike[] $blog_likes
 * @property \App\Model\Entity\BlogLike[] $likers
 * @property \App\Model\Entity\Gallery[] $galleries
 * @property \App\Model\Entity\User $user
 */
class Blog extends Entity
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
        'cover_image_fullpath'
    ];
	
	protected function _getCoverImageFullpath()
    {
        return 'http://app.ucciudaipur.in/webroot/'.$this->_properties['cover_image'];
    }
}
