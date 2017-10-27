<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterPurposes Model
 *
 * @property \Cake\ORM\Association\HasMany $ProposeBudgets
 *
 * @method \App\Model\Entity\MasterPurpose get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterPurpose newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterPurpose[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterPurpose|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterPurpose patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterPurpose[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterPurpose findOrCreate($search, callable $callback = null)
 */
class MasterPurposesTable extends Table
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

        $this->table('master_purposes');
        $this->displayField('purpose_name');
        $this->primaryKey('id');

        $this->hasMany('ProposeBudgets', [
            'foreignKey' => 'master_purpose_id'
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
            ->requirePresence('purpose_name', 'create')
            ->notEmpty('purpose_name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

       /*  $validator
            ->integer('purpose_tax')
            ->requirePresence('purpose_tax', 'create')
            ->notEmpty('purpose_tax');

        $validator
            ->integer('purpose_flag')
            ->requirePresence('purpose_flag', 'create')
            ->notEmpty('purpose_flag');
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
       // $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
