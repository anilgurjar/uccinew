<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BusinessVisas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 *
 * @method \App\Model\Entity\BusinessVisa get($primaryKey, $options = [])
 * @method \App\Model\Entity\BusinessVisa newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BusinessVisa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BusinessVisa|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BusinessVisa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessVisa[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BusinessVisa findOrCreate($search, callable $callback = null)
 */
class BusinessVisasTable extends Table
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

        $this->table('business_visas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
		
		$this->belongsTo('MasterCompanies');
		$this->belongsTo('MemberReceipts');
		$this->belongsTo('MasterTaxations');
		$this->belongsTo('CertificateOriginAuthorizeds');
		$this->belongsTo('Users');
		
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
            ->requirePresence('sender_address', 'create')
            ->notEmpty('sender_address');
			
		 $validator
		->requirePresence('company_id', 'create')
		->notEmpty('company_id');


        $validator
            ->requirePresence('company_manufacture', 'create')
            ->notEmpty('company_manufacture');

        $validator
            ->requirePresence('subject', 'create')
            ->notEmpty('subject');

        $validator
            ->requirePresence('visitor_name', 'create')
            ->notEmpty('visitor_name');

        $validator
            ->requirePresence('visitor_designation', 'create')
            ->notEmpty('visitor_designation');

        $validator
            ->requirePresence('visit_country', 'create')
            ->notEmpty('visit_country');

        $validator
            ->requirePresence('visit_month', 'create')
            ->notEmpty('visit_month');

        $validator
            ->requirePresence('visit_reason', 'create')
            ->notEmpty('visit_reason');

        $validator
            ->requirePresence('passport_no', 'create')
            ->notEmpty('passport_no');

        $validator
            ->date('issue_date')
            ->requirePresence('issue_date', 'create')
            ->notEmpty('issue_date');

        $validator
            ->requirePresence('issue_place', 'create')
            ->notEmpty('issue_place');

        $validator
            ->date('expiry_date')
            ->requirePresence('expiry_date', 'create')
            ->notEmpty('expiry_date');

        $validator
            ->date('date_current')
            ->requirePresence('date_current', 'create')
            ->notEmpty('date_current');

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
