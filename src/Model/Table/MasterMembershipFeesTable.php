<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterMembershipFees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $MemberTypes
 *
 * @method \App\Model\Entity\MasterMembershipFee get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterMembershipFee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterMembershipFee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterMembershipFee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterMembershipFee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterMembershipFee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterMembershipFee findOrCreate($search, callable $callback = null)
 */
class MasterMembershipFeesTable extends Table
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

        $this->table('master_membership_fees');
        $this->displayField('id');
        $this->primaryKey('id');

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
            ->requirePresence('component', 'create')
            ->notEmpty('component');

        $validator
            ->integer('category_name')
            ->requirePresence('category_name', 'create')
            ->notEmpty('category_name');

        $validator
            ->decimal('subscription_amount')
            ->requirePresence('subscription_amount', 'create')
            ->notEmpty('subscription_amount');

        $validator
            ->requirePresence('HSN', 'create')
            ->notEmpty('HSN');

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
        $rules->add($rules->existsIn(['member_type_id'], 'MemberTypes'));

        return $rules;
    }
}
