<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Module Entity
 *
 * @property int $id
 * @property string $name
 * @property string $main_menu
 * @property string $main_menu_icon
 * @property string $sub_menu
 * @property string $sub_menu_icon
 * @property string $controller
 * @property string $page_name_url
 * @property string $icon_class_name
 * @property string $query_string
 * @property string $target
 * @property string $tooltips
 * @property int $preferance
 *
 * @property \App\Model\Entity\UserRight[] $user_rights
 */
class Module extends Entity
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
