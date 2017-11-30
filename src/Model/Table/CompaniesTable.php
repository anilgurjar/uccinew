<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Companies Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\BelongsTo $CompanyEmails
 * @property \Cake\ORM\Association\BelongsTo $MemberTypes
 * @property \Cake\ORM\Association\BelongsTo $TurnOvers
 * @property \Cake\ORM\Association\HasMany $BusinessVisas
 * @property \Cake\ORM\Association\HasMany $CertificateOrigins
 * @property \Cake\ORM\Association\HasMany $CompanyMemberTypes
 * @property \Cake\ORM\Association\HasMany $MemberFees
 * @property \Cake\ORM\Association\HasMany $MemberReceipts
 * @property \Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Company get($primaryKey, $options = [])
 * @method \App\Model\Entity\Company newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Company[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Company|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Company[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Company findOrCreate($search, callable $callback = null)
 */
class CompaniesTable extends Table
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

        $this->table('companies');
        $this->displayField('company_organisation');
        $this->primaryKey('id');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
       
        $this->belongsTo('MasterMemberTypes', [
            'foreignKey' => 'master_member_type_id',
            'joinType' => 'INNER'
        ]);

		$this->belongsTo('MasterCategories', [
            'foreignKey' => 'category',
         ]);

		$this->belongsTo('MasterGrades', [
			'foreignKey' => 'grade',
 		]);

		$this->belongsTo('MasterTaxations');
		$this->belongsTo('MasterMembershipFees');
		$this->belongsTo('MasterFinancialYears');
		$this->belongsTo('MasterCompanies');
		
		$this->belongsTo('MasterClassifications', [
			'foreignKey' => 'classification',
 		]);


        $this->belongsTo('MasterTurnOvers', [
            'foreignKey' => 'turn_over_id',
        ]);
        $this->hasMany('BusinessVisas', [
            'foreignKey' => 'company_id'
        ]); 
		$this->hasMany('CooCoupons', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CertificateOrigins', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyMemberTypes', [
            'foreignKey' => 'company_id',
			'saveStrategy'=>'replace'
        ]);  
        $this->hasMany('MemberFees', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('MemberReceipts', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'company_id',
			'saveStrategy'=>'replace'
        ]);
		$this->hasMany('CoRegistrations', [
            'foreignKey' => 'company_id',
			'saveStrategy'=>'replace'
        ]);
		
		 $this->hasMany('UserRights', [
            'foreignKey' => 'user_id'
        ]);
		
		$this->hasMany('UserProfiles', [
            'foreignKey' => 'company_id'
        ]);
		$this->hasMany('CompanyWasteInformations', [
            'foreignKey' => 'company_id'
        ]); 
		$this->hasMany('CompanyWastageInformations', [
            'foreignKey' => 'company_id'
        ]);
		$this->hasMany('CompanyHwmInformations', [
            'foreignKey' => 'company_id'
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
            ->requirePresence('company_organisation', 'create')
            ->notEmpty('company_organisation');

      /*   $validator
            ->requirePresence('gst_number', 'create')
            ->notEmpty('gst_number');

        $validator
            ->integer('id_card_no')
            ->requirePresence('id_card_no', 'create')
            ->notEmpty('id_card_no');

       

        $validator
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->requirePresence('city', 'create')
            ->notEmpty('city');

        $validator
            ->integer('pincode')
            ->requirePresence('pincode', 'create')
            ->notEmpty('pincode');

        $validator
            ->requirePresence('end_products_item_dealing_in', 'create')
            ->notEmpty('end_products_item_dealing_in');

        $validator
            ->requirePresence('office_telephone', 'create')
            ->notEmpty('office_telephone');

        $validator
            ->requirePresence('residential_telephone', 'create')
            ->notEmpty('residential_telephone');

        $validator
            ->integer('grade')
            ->requirePresence('grade', 'create')
            ->notEmpty('grade');

        $validator
            ->integer('category')
            ->requirePresence('category', 'create')
            ->notEmpty('category');

        $validator
            ->integer('classification')
            ->requirePresence('classification', 'create')
            ->notEmpty('classification');

        $validator
            ->date('year_of_joining')
            ->requirePresence('year_of_joining', 'create')
            ->notEmpty('year_of_joining');

        $validator
            ->decimal('due_amount')
            ->requirePresence('due_amount', 'create')
            ->notEmpty('due_amount');

        $validator
            ->integer('member_flag')
            ->requirePresence('member_flag', 'create')
            ->notEmpty('member_flag');

        $validator
            ->requirePresence('website', 'create')
            ->notEmpty('website');

        $validator
            ->requirePresence('tag', 'create')
            ->notEmpty('tag');

        $validator
            ->requirePresence('infrastructure', 'create')
            ->notEmpty('infrastructure');

        $validator
            ->requirePresence('brief_description', 'create')
            ->notEmpty('brief_description'); */

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
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
       // $rules->add($rules->existsIn(['company_email_id'], 'CompanyEmails'));
      //  $rules->add($rules->existsIn(['member_type_id'], 'MemberTypes'));
      //  $rules->add($rules->existsIn(['turn_over_id'], 'TurnOvers'));

        return $rules;
    }
}
