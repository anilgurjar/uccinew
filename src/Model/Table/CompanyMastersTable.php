<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompanyMasters Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\BelongsTo $CompanyEmails
 * @property \Cake\ORM\Association\BelongsTo $MemberTypes
 * @property \Cake\ORM\Association\BelongsTo $TurnOvers
 * @property \Cake\ORM\Association\HasMany $MembershipDueAmounts
 * @property \Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\CompanyMaster get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompanyMaster newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CompanyMaster[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompanyMaster|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompanyMaster patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyMaster[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyMaster findOrCreate($search, callable $callback = null)
 */
class CompanyMastersTable extends Table
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

        $this->table('company_masters');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
       
        $this->belongsTo('MasterMemberTypes', [
            'foreignKey' => 'member_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MasterTurnOvers', [
            'foreignKey' => 'turn_over_id',
            'joinType' => 'INNER'
        ]);
        
        $this->hasMany('Users', [
            'foreignKey' => 'company_master_id'
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

      /*   $validator
            ->requirePresence('gst_number', 'create')
            ->notEmpty('gst_number');

        $validator
            ->integer('id_card_no')
            ->requirePresence('id_card_no', 'create')
            ->notEmpty('id_card_no');

        $validator
            ->requirePresence('company_organisation', 'create')
            ->notEmpty('company_organisation');

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
        
        $rules->add($rules->existsIn(['member_type_id'], 'MasterMemberTypes'));
        $rules->add($rules->existsIn(['turn_over_id'], 'MasterTurnOvers'));

        return $rules;
    }
}
