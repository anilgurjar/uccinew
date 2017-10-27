<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SurveyAnswers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $SurveyQuestions
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $SurveyQuestionRows
 * @property \Cake\ORM\Association\HasMany $SurveyAnswerRows
 *
 * @method \App\Model\Entity\SurveyAnswer get($primaryKey, $options = [])
 * @method \App\Model\Entity\SurveyAnswer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SurveyAnswer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SurveyAnswer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SurveyAnswer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SurveyAnswer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SurveyAnswer findOrCreate($search, callable $callback = null)
 */
class SurveyAnswersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('survey_answers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('SurveyQuestions', [
            'foreignKey' => 'survey_question_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SurveyQuestionRows', [
            'foreignKey' => 'survey_question_row_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('SurveyAnswerRows', [
            'foreignKey' => 'survey_answer_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

      /*   $validator
            ->requirePresence('answer', 'create')
            ->notEmpty('answer');
 */
        $validator
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['survey_question_id'], 'SurveyQuestions'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['survey_question_row_id'], 'SurveyQuestionRows'));

        return $rules;
    }
}
