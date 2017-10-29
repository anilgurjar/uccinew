<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterSessions Model
 *
 * @method \App\Model\Entity\MasterSession get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterSession newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterSession[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterSession|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterSession patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterSession[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterSession findOrCreate($search, callable $callback = null)
 */
class MasterSessionsTable extends Table
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

        $this->table('master_sessions');
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
            ->requirePresence('session', 'create')
            ->notEmpty('session');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
