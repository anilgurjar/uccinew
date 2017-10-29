<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SurveyQuestionRow Entity
 *
 * @property int $id
 * @property int $survey_question_id
 * @property string $objective
 * @property \Cake\I18n\Time $date
 *
 * @property \App\Model\Entity\SurveyQuestion $survey_question
 */
class SurveyQuestionRow extends Entity
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
