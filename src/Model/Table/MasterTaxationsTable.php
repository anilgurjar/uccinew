<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MasterTaxations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Taxes
 * @property \Cake\ORM\Association\HasMany $MasterTaxationRates
 *
 * @method \App\Model\Entity\MasterTaxation get($primaryKey, $options = [])
 * @method \App\Model\Entity\MasterTaxation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MasterTaxation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MasterTaxation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MasterTaxation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MasterTaxation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MasterTaxation findOrCreate($search, callable $callback = null)
 */
class MasterTaxationsTable extends Table
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

        $this->table('master_taxations');
        $this->displayField('tax_id');
        $this->primaryKey('tax_id');

        $this->belongsTo('Taxes', [
            'foreignKey' => 'tax_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('MasterTaxationRates', [
            'foreignKey' => 'master_taxation_id'
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
            ->requirePresence('tax_name', 'create')
            ->notEmpty('tax_name');

        $validator
            ->integer('tax_flag')
            ->requirePresence('tax_flag', 'create')
            ->notEmpty('tax_flag');

        $validator
            ->requirePresence('gst_name', 'create')
            ->notEmpty('gst_name');

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
        $rules->add($rules->existsIn(['tax_id'], 'Taxes'));

        return $rules;
    }
}
