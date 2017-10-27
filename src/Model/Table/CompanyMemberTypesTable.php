<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompanyMemberTypes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $MasterMemberTypes
 * @property \Cake\ORM\Association\HasMany $MemberFees
 *
 * @method \App\Model\Entity\CompanyMemberType get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompanyMemberType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CompanyMemberType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompanyMemberType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompanyMemberType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyMemberType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyMemberType findOrCreate($search, callable $callback = null)
 */
class CompanyMemberTypesTable extends Table
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

        $this->table('company_member_types');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MasterMemberTypes', [
            'foreignKey' => 'master_member_type_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('MemberFees', [
            'foreignKey' => 'company_member_type_id'
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
            ->decimal('due_amount')
            ->requirePresence('due_amount', 'create')
            ->notEmpty('due_amount');

        $validator
            ->integer('flag')
            ->requirePresence('flag', 'create')
            ->notEmpty('flag');
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
  /*   public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        //$rules->add($rules->existsIn(['master_member_type_id'], 'MasterMemberTypes'));

        return $rules;
    } */
}
