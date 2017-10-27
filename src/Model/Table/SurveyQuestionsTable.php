<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SurveyQuestions Model
 *
 * @property \Cake\ORM\Association\HasMany $SurveyQuestionRows
 *
 * @method \App\Model\Entity\SurveyQuestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\SurveyQuestion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SurveyQuestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SurveyQuestion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SurveyQuestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SurveyQuestion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SurveyQuestion findOrCreate($search, callable $callback = null)
 */
class SurveyQuestionsTable extends Table
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

        $this->table('survey_questions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('SurveyQuestionRows', [
            'foreignKey' => 'survey_question_id'
        ]);
		
		 $this->hasMany('SurveyAnswers', [
            'foreignKey' => 'survey_question_id'
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

        $validator
            ->requirePresence('question', 'create')
            ->notEmpty('question');

        $validator
            ->requirePresence('question_type', 'create')
            ->notEmpty('question_type');

       /*  $validator
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');
 */
        return $validator;
    }
}
