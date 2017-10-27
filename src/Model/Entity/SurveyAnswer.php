<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SurveyAnswer Entity
 *
 * @property int $id
 * @property int $survey_question_id
 * @property int $user_id
 * @property int $survey_question_row_id
 * @property string $answer
 * @property string $type
 *
 * @property \App\Model\Entity\SurveyQuestion $survey_question
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\SurveyQuestionRow $survey_question_row
 * @property \App\Model\Entity\SurveyAnswerRow[] $survey_answer_rows
 */
class SurveyAnswer extends Entity
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
