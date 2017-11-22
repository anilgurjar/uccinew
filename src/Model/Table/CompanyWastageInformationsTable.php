<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompanyWastageInformations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 *
 * @method \App\Model\Entity\CompanyWastageInformation get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompanyWastageInformation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CompanyWastageInformation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompanyWastageInformation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompanyWastageInformation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyWastageInformation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyWastageInformation findOrCreate($search, callable $callback = null)
 */
class CompanyWastageInformationsTable extends Table
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

        $this->table('company_wastage_informations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
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
            ->requirePresence('code_hm_rule', 'create')
            ->notEmpty('code_hm_rule');

        $validator
            ->requirePresence('waste_description_incinerable', 'create')
            ->notEmpty('waste_description_incinerable');

        $validator
            ->requirePresence('waste_description_non', 'create')
            ->notEmpty('waste_description_non');

        $validator
            ->requirePresence('quantity_month_incinerable', 'create')
            ->notEmpty('quantity_month_incinerable');

        $validator
            ->requirePresence('quantity_month_non', 'create')
            ->notEmpty('quantity_month_non');

        $validator
            ->requirePresence('inventory_incinerable', 'create')
            ->notEmpty('inventory_incinerable');

        $validator
            ->requirePresence('inventory_non', 'create')
            ->notEmpty('inventory_non');

        $validator
            ->requirePresence('storage_method_incinerable', 'create')
            ->notEmpty('storage_method_incinerable');

        $validator
            ->requirePresence('storage_method_non', 'create')
            ->notEmpty('storage_method_non');

        $validator
            ->dateTime('timestamp')
            ->requirePresence('timestamp', 'create')
            ->notEmpty('timestamp');

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
        $rules->add($rules->existsIn(['company_id'], 'Companies'));

        return $rules;
    }
}
