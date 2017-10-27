<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MembershipDueAmounts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CompanyMasters
 * @property \Cake\ORM\Association\BelongsTo $MemberTypes
 *
 * @method \App\Model\Entity\MembershipDueAmount get($primaryKey, $options = [])
 * @method \App\Model\Entity\MembershipDueAmount newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MembershipDueAmount[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MembershipDueAmount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MembershipDueAmount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MembershipDueAmount[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MembershipDueAmount findOrCreate($search, callable $callback = null)
 */
class MembershipDueAmountsTable extends Table
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

        $this->table('membership_due_amounts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MasterMemberTypes', [
            'foreignKey' => 'member_type_id',
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
			->notEmpty('member_type_id', 'A member_type is required');
			
       /*  $validator
            ->decimal('due_amount')
            ->requirePresence('due_amount', 'create')
            ->notEmpty('due_amount');

        $validator
            ->integer('flag')
            ->requirePresence('flag', 'create')
            ->notEmpty('flag'); */

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
        //$rules->add($rules->existsIn(['company_master_id'], 'CompanyMasters'));
        //$rules->add($rules->existsIn(['member_type_id'], 'MemberTypes'));

        return $rules;
    }
}
