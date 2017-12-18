<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * IndustrialGrievances Model
 *
 * @property \Cake\ORM\Association\BelongsTo $GrievanceCategories
 * @property \Cake\ORM\Association\BelongsTo $IndustrialDepartments
 * @property \Cake\ORM\Association\BelongsTo $GrievanceIssues
 * @property \Cake\ORM\Association\BelongsTo $GrievanceIssueRelateds
 * @property \Cake\ORM\Association\HasMany $IndustrialGrievanceFollows
 * @property \Cake\ORM\Association\HasMany $IndustrialGrievanceStatuses
 *
 * @method \App\Model\Entity\IndustrialGrievance get($primaryKey, $options = [])
 * @method \App\Model\Entity\IndustrialGrievance newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\IndustrialGrievance[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\IndustrialGrievance|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IndustrialGrievance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\IndustrialGrievance[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\IndustrialGrievance findOrCreate($search, callable $callback = null)
 */
class IndustrialGrievancesTable extends Table
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

        $this->table('industrial_grievances');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('GrievanceCategories', [
            'foreignKey' => 'grievance_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('IndustrialDepartments', [
            'foreignKey' => 'industrial_department_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('GrievanceIssues', [
            'foreignKey' => 'grievance_issue_id',
            'joinType' => 'INNER'
        ]); 
		$this->belongsTo('Users', [
            'foreignKey' => 'created_by',
            'joinType' => 'INNER'
        ]);
		$this->belongsTo('Companies', [
            'foreignKey' => 'industrial_department_id',
            'joinType' => 'INNER'
        ]);
		
		//$this->belongsTo('Companies');
		
        $this->belongsTo('GrievanceIssueRelateds', [
            'foreignKey' => 'grievance_issue_related_id',
            'joinType' => 'INNER'
        ]);
		
        $this->hasMany('IndustrialGrievanceFollows', [
            'foreignKey' => 'industrial_grievance_id'
        ]);
        $this->hasMany('IndustrialGrievanceStatuses', [
            'foreignKey' => 'industrial_grievance_id'
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

       /*  $validator
            ->integer('grievance_number')
            ->requirePresence('grievance_number', 'create')
            ->notEmpty('grievance_number');

        $validator
            ->requirePresence('lodge_same_grievance', 'create')
            ->notEmpty('lodge_same_grievance');

        $validator
            ->requirePresence('grievance_period', 'create')
            ->notEmpty('grievance_period');

        $validator
            ->integer('grievance_age')
            ->requirePresence('grievance_age', 'create')
            ->notEmpty('grievance_age');

        $validator
            ->requirePresence('document', 'create')
            ->notEmpty('document');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->requirePresence('location', 'create')
            ->notEmpty('location');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->integer('mail_status')
            ->requirePresence('mail_status', 'create')
            ->notEmpty('mail_status');

        $validator
            ->requirePresence('complete_status', 'create')
            ->notEmpty('complete_status');

        $validator
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

        $validator
            ->date('close_date')
            ->requirePresence('close_date', 'create')
            ->notEmpty('close_date');

        $validator
            ->requirePresence('reopen_reason', 'create')
            ->notEmpty('reopen_reason');

        $validator
            ->requirePresence('grievance_pdf', 'create')
            ->notEmpty('grievance_pdf');
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
        $rules->add($rules->existsIn(['grievance_category_id'], 'GrievanceCategories'));
        $rules->add($rules->existsIn(['industrial_department_id'], 'Companies'));
        $rules->add($rules->existsIn(['grievance_issue_id'], 'GrievanceIssues'));
        $rules->add($rules->existsIn(['grievance_issue_related_id'], 'GrievanceIssueRelateds'));

        return $rules;
    }
}
