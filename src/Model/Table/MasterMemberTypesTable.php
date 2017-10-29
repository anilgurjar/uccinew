<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterMemberTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $CompanyMemberTypes
 * @property \Cake\ORM\Association\HasMany $MemberRequests
 *
 * @method \App\Model\Entity\MasterMemberType get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterMemberType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterMemberType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterMemberType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterMemberType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterMemberType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterMemberType findOrCreate($search, callable $callback = null)
 */
class MasterMemberTypesTable extends Table
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

        $this->table('master_member_types');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('CompanyMemberTypes', [
            'foreignKey' => 'master_member_type_id'
        ]);
        $this->hasMany('MemberRequests', [
            'foreignKey' => 'master_member_type_id'
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
            ->requirePresence('member_type', 'create')
            ->notEmpty('member_type');

        return $validator;
    }
}
