<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterCurrencies Model
 *
 * @method \App\Model\Entity\MasterCurrency get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterCurrency newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterCurrency[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterCurrency|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterCurrency patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterCurrency[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterCurrency findOrCreate($search, callable $callback = null)
 */
class MasterCurrenciesTable extends Table
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

        $this->table('master_currencies');
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
            ->requirePresence('currency_type', 'create')
            ->notEmpty('currency_type');

        return $validator;
    }
}
