<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompanyHwmInformations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 *
 * @method \App\Model\Entity\CompanyHwmInformation get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompanyHwmInformation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CompanyHwmInformation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompanyHwmInformation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompanyHwmInformation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyHwmInformation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyHwmInformation findOrCreate($search, callable $callback = null)
 */
class CompanyHwmInformationsTable extends Table
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

        $this->table('company_hwm_informations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
		$this->belongsTo('CompanyWasteInformations');
		$this->belongsTo('CompanyWastageInformations'); 
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
            ->requirePresence('company_name', 'create')
            ->notEmpty('company_name');
		/*
        $validator
            ->requirePresence('waste_description', 'create')
            ->notEmpty('waste_description');

        $validator
            ->requirePresence('waste_type_number', 'create')
            ->notEmpty('waste_type_number');

        $validator
            ->requirePresence('process_generating_waste', 'create')
            ->notEmpty('process_generating_waste');

        $validator
            ->requirePresence('generation_rate', 'create')
            ->notEmpty('generation_rate');

        $validator
            ->requirePresence('disposal_arrangement', 'create')
            ->notEmpty('disposal_arrangement');

        $validator
            ->requirePresence('chemical_composition', 'create')
            ->notEmpty('chemical_composition');

        $validator
            ->requirePresence('company_service_type', 'create')
            ->notEmpty('company_service_type');

        $validator
            ->requirePresence('chemical_composition_sheet', 'create')
            ->notEmpty('chemical_composition_sheet');

        $validator
            ->requirePresence('off_site_company_name', 'create')
            ->notEmpty('off_site_company_name');

        $validator
            ->requirePresence('off_site_address', 'create')
            ->notEmpty('off_site_address');

        $validator
            ->requirePresence('on_site_disposal_method', 'create')
            ->notEmpty('on_site_disposal_method');

        $validator
            ->requirePresence('disposal_waste_use', 'create')
            ->notEmpty('disposal_waste_use');

        $validator
            ->requirePresence('waste_stream', 'create')
            ->notEmpty('waste_stream');

        $validator
            ->requirePresence('solid_type', 'create')
            ->notEmpty('solid_type');

        $validator
            ->requirePresence('liquid_type', 'create')
            ->notEmpty('liquid_type');

        $validator
            ->requirePresence('sludge_type', 'create')
            ->notEmpty('sludge_type');

        $validator
            ->requirePresence('constituents_present', 'create')
            ->notEmpty('constituents_present');

        $validator
            ->requirePresence('principal_components', 'create')
            ->notEmpty('principal_components');

        $validator
            ->requirePresence('acidic_basic', 'create')
            ->notEmpty('acidic_basic');

        $validator
            ->requirePresence('waste_combustible', 'create')
            ->notEmpty('waste_combustible');

        $validator
            ->requirePresence('potential_reuse', 'create')
            ->notEmpty('potential_reuse');

        $validator
            ->dateTime('timestamp')
            ->requirePresence('timestamp', 'create')
            ->notEmpty('timestamp');
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
        $rules->add($rules->existsIn(['company_id'], 'Companies'));

        return $rules;
    }
}
