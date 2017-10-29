<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CoRegistrations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $MasterFinancialYears
 * @property \Cake\ORM\Association\HasMany $CoTaxAmounts
 *
 * @method \App\Model\Entity\CoRegistration get($primaryKey, $options = [])
 * @method \App\Model\Entity\CoRegistration newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CoRegistration[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CoRegistration|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CoRegistration patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CoRegistration[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CoRegistration findOrCreate($search, callable $callback = null)
 */
class CoRegistrationsTable extends Table
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

        $this->table('co_registrations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MasterFinancialYears', [
            'foreignKey' => 'master_financial_year_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('CoTaxAmounts', [
            'foreignKey' => 'co_registration_id'
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
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->decimal('tax_amount')
            ->requirePresence('tax_amount', 'create')
            ->notEmpty('tax_amount');

        $validator
            ->decimal('total_amount')
            ->requirePresence('total_amount', 'create')
            ->notEmpty('total_amount');

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
        $rules->add($rules->existsIn(['master_financial_year_id'], 'MasterFinancialYears'));

        return $rules;
    }
}
