<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompanyWasteInformations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 *
 * @method \App\Model\Entity\CompanyWasteInformation get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompanyWasteInformation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CompanyWasteInformation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompanyWasteInformation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompanyWasteInformation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyWasteInformation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyWasteInformation findOrCreate($search, callable $callback = null)
 */
class CompanyWasteInformationsTable extends Table
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

        $this->table('company_waste_informations');
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
/*
        $validator
            ->requirePresence('number', 'create')
            ->notEmpty('number');

        $validator
            ->requirePresence('waste_type', 'create')
            ->notEmpty('waste_type');

        $validator
            ->requirePresence('volume', 'create')
            ->notEmpty('volume');

        $validator
            ->requirePresence('inventory', 'create')
            ->notEmpty('inventory');

        $validator
            ->requirePresence('storage_method', 'create')
            ->notEmpty('storage_method');

        $validator
            ->requirePresence('size_storage_container', 'create')
            ->notEmpty('size_storage_container');

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
