<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterTurnOvers Model
 *
 * @method \App\Model\Entity\MasterTurnOver get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterTurnOver newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterTurnOver[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterTurnOver|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterTurnOver patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterTurnOver[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterTurnOver findOrCreate($search, callable $callback = null)
 */
class MasterTurnOversTable extends Table
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

        $this->table('master_turn_overs');
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

        /* $validator
            ->requirePresence('HSN', 'create')
            ->notEmpty('HSN'); */

        return $validator;
    }
}
