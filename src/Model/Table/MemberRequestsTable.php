<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MemberRequests Model
 *
 * @property \Cake\ORM\Association\BelongsTo $MasterMemberTypes
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\MemberRequest get($primaryKey, $options = [])
 * @method \App\Model\Entity\MemberRequest newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MemberRequest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MemberRequest|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MemberRequest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MemberRequest[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MemberRequest findOrCreate($search, callable $callback = null)
 */
class MemberRequestsTable extends Table
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

        $this->table('member_requests');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('MasterMemberTypes', [
            'foreignKey' => 'master_member_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('company_name', 'create')
            ->notEmpty('company_name');

        $validator
            ->requirePresence('company_address', 'create')
            ->notEmpty('company_address');

        $validator
            ->requirePresence('designation', 'create')
            ->notEmpty('designation');

        $validator
            ->requirePresence('remarks', 'create')
            ->notEmpty('remarks');

        $validator
            ->dateTime('request_date')
            ->requirePresence('request_date', 'create')
            ->notEmpty('request_date');

        $validator
            ->requirePresence('website', 'create')
            ->notEmpty('website');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['master_member_type_id'], 'MasterMemberTypes'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
