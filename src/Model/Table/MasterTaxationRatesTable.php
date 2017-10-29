<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterTaxationRates Model
 *
 * @property \Cake\ORM\Association\BelongsTo $MasterTaxations
 *
 * @method \App\Model\Entity\MasterTaxationRate get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterTaxationRate newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterTaxationRate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterTaxationRate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterTaxationRate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterTaxationRate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterTaxationRate findOrCreate($search, callable $callback = null)
 */
class MasterTaxationRatesTable extends Table
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

        $this->table('master_taxation_rates');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('MasterTaxations', [
            'foreignKey' => 'master_taxation_id',
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
            ->decimal('tax_percentage')
            ->requirePresence('tax_percentage', 'create')
            ->notEmpty('tax_percentage');

        $validator
            ->date('tax_date')
            ->requirePresence('tax_date', 'create')
            ->notEmpty('tax_date');

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
        $rules->add($rules->existsIn(['master_taxation_id'], 'MasterTaxations'));

        return $rules;
    }
}
