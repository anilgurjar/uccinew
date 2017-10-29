<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExecutiveMembers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $MasterFinancialYears
 * @property \Cake\ORM\Association\BelongsTo $ExecutiveCategories
 * @property \Cake\ORM\Association\BelongsTo $Designations
 *
 * @method \App\Model\Entity\ExecutiveMember get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExecutiveMember newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExecutiveMember[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExecutiveMember|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExecutiveMember patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExecutiveMember[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExecutiveMember findOrCreate($search, callable $callback = null)
 */
class ExecutiveMembersTable extends Table
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

        $this->table('executive_members');
        $this->displayField('id');
        $this->primaryKey('id');

		$this->belongsTo('MasterFinancialYears');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MasterFinancialYears', [
            'foreignKey' => 'master_financial_year_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ExecutiveCategories', [
            'foreignKey' => 'executive_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Designations', [
            'foreignKey' => 'designation_id'
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
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on'); */

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['master_financial_year_id'], 'MasterFinancialYears'));
        $rules->add($rules->existsIn(['executive_category_id'], 'ExecutiveCategories'));
        $rules->add($rules->existsIn(['designation_id'], 'Designations'));

        return $rules;
    }
}
