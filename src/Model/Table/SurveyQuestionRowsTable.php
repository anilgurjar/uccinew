<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SurveyQuestionRows Model
 *
 * @property \Cake\ORM\Association\BelongsTo $SurveyQuestions
 *
 * @method \App\Model\Entity\SurveyQuestionRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\SurveyQuestionRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SurveyQuestionRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SurveyQuestionRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SurveyQuestionRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SurveyQuestionRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SurveyQuestionRow findOrCreate($search, callable $callback = null)
 */
class SurveyQuestionRowsTable extends Table
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

        $this->table('survey_question_rows');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('SurveyQuestions', [
            'foreignKey' => 'survey_question_id',
            'joinType' => 'INNER'
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
            ->requirePresence('objective', 'create')
            ->notEmpty('objective');
/* 
        $validator
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');
 */
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

        return $rules;
    }
}
