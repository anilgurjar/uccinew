<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterBanks Model
 *
 * @method \App\Model\Entity\MasterBank get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterBank newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterBank[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterBank|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterBank patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterBank[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterBank findOrCreate($search, callable $callback = null)
 */
class MasterBanksTable extends Table
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

        $this->table('master_banks');
        $this->displayField('id');
        $this->primaryKey('id');
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
            ->requirePresence('bank_name', 'create')
            ->notEmpty('bank_name');

        $validator
            ->requirePresence('branch_name', 'create')
            ->notEmpty('branch_name');

        $validator
            ->requirePresence('ifsc_code', 'create')
            ->notEmpty('ifsc_code');

        return $validator;
    }
}
